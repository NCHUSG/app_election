<?php
class admin extends BaseController {

    public function login()
    {
        if (!Session::has('login'))
            return Redirect::route('oauth');
        else
            return Redirect::route('admin_view');
    }

    public function logout()
    {
        Session::forget('login');
        Session::set('msg',"已登出");
        Session::set('msg_status',"success");
        return Redirect::route('msg');
    }

    public function oauth()
    {
        $key    = Config::get('app_const.ilt_key');
        $secret = Config::get('app_const.ilt_secret');
        $host   = Config::get('app_const.ilt_host');
        $group  = Config::get('app_const.ilt_authorized_group');
        $scope  = "user.login.basic+user.isIn.$group";

        # Here is the most important part about using this library.
        $client       = new IltOAuthClient($key, $secret, $host, $scope);
        $user_files   = $client->run();

        if( $user_files !== NULL ){
            try{
                if ( $user_files === false )
                    throw new Exception("ilt's response is invalid. 會員系統的回應錯誤");
                if($user_files->status !== 1)
                    throw new Exception("ilt's status of response is invalid. 會員系統的回應錯誤");
                if($user_files->data->isIn->$group !== true)
                    throw new Exception("You are not in the valid ilt group! 您在 ILT 會員系統沒有取得正確權限");
                Session::set('login',$user_files);
                Session::set('msg',"登入成功!");
                Session::set('msg_status',"success");
                return Redirect::route('msg');
            }
            catch(Exception $e){
                Session::set('msg',"登入失敗:" . $e->getMessage());
                Session::set('msg_status',"danger");
                return Redirect::route('msg');
            }
        }

        return;
    }

    public function delete($id){
        try{
            $candidate = candidate::findOrFail($id);
            if($candidate->regis_type == 1) throw new Exception("副會長候選人無法刪除，請刪除對應之會長候選人");
            $candidate->delete();
            Session::set('msg',"刪除成功");
            Session::set('msg_status',"success");
        }catch(Exception $e){
            Session::set('msg',"刪除失敗：" . $e->getMessage());
            Session::set('msg_status',"danger");
        }
        return Redirect::route('msg');
    }
}
