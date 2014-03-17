<?php
class regis extends BaseController {

    private $view_var=array();
    private $app_const=array();
    private $time_stamp;

    private $debug_mode=false;

    public function __construct()
    {
        //parent::__construct();
        // No need to call parent's constructor

        $this->view_var['const'] = Config::get('view_const');

        $this->app_const = Config::get('app_const');

        $this->time_stamp = time();
    }

    public function test()
    {
        //$this->view_var['candidate']=candidate::where('id', '=', 16)->take(1)->get();
        return 'timestamp:'.time().'<br>now:'.date(DATE_RFC2822)."<br>start:".date(DATE_RFC2822,$this->app_const['Timestamp_allowRegis'])."<br>end:".date(DATE_RFC2822,$this->app_const['Timestamp_allowRegisEnd']);

        //return hash('crc32b','邱冠喻0970900813資訊科學與工程學系三年級');
    }

    public function form($type)
    {
        try {
            $this->time_check();
            //$form = Form::model($user, array('route' => array('user.update', $user->id)));
            if($type!=0 && $type!=2 && $type!=3)
                throw new Exception("Wrong type!");
            if($type==0)
                $this->view_var['NumberOfCandidate']=2;
            else
                $this->view_var['NumberOfCandidate']=1;

            $this->view_var['type']=$type;
            $this->view_var['enable_recaptcha']=$this->app_const['enable_recaptcha'];
            
            return View::make('form',$this->view_var);
        } catch (Exception $e) {
            $this->view_var['message']=$e->getMessage();
            return View::make('failed',$this->view_var);
        }
    }

    public function form_sent()
    {
        try {
            $this->time_check();

            $canditates=Input::get('candidate');

            $this->recaptcha_valid_if_enabled();

            $id=0;
            $photo_tmp=array();
            foreach ($canditates as $key => $value) {
                $this->valid($value,$this->app_const['validationRule']);
                $photo_tmp[$key]=$this->photo_valid_and_to_tmp($key);
            }

            foreach ($canditates as $key => $value) {
                $value['regis_type']=$key;
                $value['type_data']=$id;

                $id=$this->candidate_add($value);
                $this->photo_to_upload($photo_tmp[$key],$id);
            }

            $this->view_var['info']=$this->app_const['regis_success_info'];
            return View::make('regisOK',$this->view_var);
        } catch (Exception $e) {
            $this->view_var['message']=$e->getMessage();
            return View::make('failed',$this->view_var);
        }
    }

    public function modify()
    {
        try {
            
            $this->time_check();

            if(!Input::has('code'))
                $step=0; // step 0 : enter the code
            else
                if(Input::has('id'))
                    $step=2; // step 2 : process the modify request
                else
                    $step=1; // step 1 : show modifiable data
            
            switch ($step) {
                case 0:
                    $this->view_var['enable_recaptcha']=$this->app_const['enable_recaptcha'];
                    return View::make('enterCode',$this->view_var);
                    break;
                case 1:
                    $this->recaptcha_valid_if_enabled();

                    $candidate_db=candidate::where('code', '=',Input::get('code'));

                    if($candidate_db->count() == 0)
                        throw new Exception("錯誤的驗證碼！");

                    $this->view_var['candidate']=$candidate_db->first();
                    
                    $this->view_var['allowModify']=$this->app_const['allowModify'];
                    $this->view_var['allowModifyPhoto']=$this->app_const['allowModifyPhoto'];
                    return View::make('modify',$this->view_var);
                    break;
                case 2:
                    $candidate_db=candidate::whereRaw("code = '".Input::get('code')."' and id = ".Input::get('id'));
                    if($candidate_db->count() == 0)
                        throw new Exception("請勿亂來！");

                    $candidate=Input::get('candidate');
                    $allowModify=$this->app_const['allowModify'];
                    $validationRule=array();
                    $modify=array();
                    foreach ($allowModify as $key => $value) {
                        if($value){
                            $validationRule[$key]=$this->app_const['validationRule'][$key];
                            $modify[$key]=$candidate[$key];
                        }
                    }
                    $this->valid($modify,$validationRule);
                    $candidate_db=$candidate_db->first();
                    $candidate_db->update($modify);

                    try {
                        $this->photo_to_upload($this->photo_valid_and_to_tmp('photo'),Input::get('id'));
                    } catch (Exception $e) {}

                    $this->view_var['candidate'][]=$candidate_db;
                    $this->view_var['info']=$this->app_const['modify_success_info'];
                    return View::make('regisOK',$this->view_var);
                    break;
                default:
                    throw new Exception("不明的錯誤！");
                    break;
            }
        } catch (Exception $e) {
            $this->view_var['message']=$e->getMessage();
            return View::make('failed',$this->view_var);
        }
    }

    private function valid($toBe_valid,$rule)
    {
        $validator = Validator::make($toBe_valid,$rule,$this->app_const['validationMsg']); //幹，太神威了，我之前那些是在寫三小
        
        $this->printvar($validator->fails(),"validator_failed");
        $this->printvar($validator->messages(),"validator_messages");

        if($validator->fails()){
            $err_obj=$validator->messages();
            $err_obj->setFormat(':key.:message');
            
            $err_arr=$err_obj->all();
            $err_msg='';

            $this->printvar($err_arr,"err_arr");

            foreach ($err_arr as $key => $value) {
                $tmp=explode('.',$value);
                $err_msg.= "欄位「".$this->app_const['col2name'][$tmp[0]]."」的資料有誤：".$tmp[1]."<br>";
            }
            $this->printvar($err_msg,"err_msg");
            throw new Exception($err_msg);
        }
    }

    private function candidate_add($candidate){
        if($candidate['agree']==='yes')
            $candidate['agree']=1;
        else
            throw new Exception("請勾選同意！");

        // generate code:
        $candidate['code']=hash('crc32b', $candidate['name'].$candidate['depart'].$candidate['phone'].$candidate['email'].$this->time_stamp);

        $this->printvar($candidate,"candidate final");

        // add to db :
        $candidate_db = candidate::create($candidate);
        $candidate_db->save(); 

        $this->view_var['candidate'][]=$candidate_db;
        $this->printvar($candidate_db,'candidate_db');
        return $candidate_db->id;
    }

    private function recaptcha_valid_if_enabled(){
        if($this->app_const['enable_recaptcha']){
            $recaptcha = Validator::make(
                array('recaptcha' => Input::get('recaptcha_response_field')),
                array('recaptcha' => 'required|recaptcha')
            );
            if ($recaptcha->fails())
                throw new Exception("錯誤的圖片驗證！");
        }
    }

    private function photo_valid_and_to_tmp($type)
    {
        //for debug
        $this->printvar($_FILES[$type],"FILES: ".$type);

        // Validate start :

        if($_FILES[$type]['size']<16)
            throw new Exception('圖片呢？');

        if($_FILES[$type]['size']>$this->app_const['PhotoAllowedSize'])
            throw new Exception('圖片檔案太大了喔');

        if(!in_array($_FILES[$type]['type'],$this->app_const['PhotoAllowedType']))
            throw new Exception('錯誤的檔案格式');

        $img_info=getimagesize($_FILES[$type]['tmp_name']);

        if($img_info===false)
            throw new Exception('檔案無法辨識...');

        if(!in_array($img_info['mime'],$this->app_const['PhotoAllowedType']))
            throw new Exception('錯誤的檔案格式');

        // Validate completed.
        
        // add to filesystem :

        try {
            $tmp_photos_dir=scandir($this->app_const['PhotoTempLocation']);
        } catch (ErrorException $e) {
            if(strpos($e->getMessage(),'No such file or directory')){
                mkdir($this->app_const['PhotoTempLocation'],0770,true);
                $tmp_photos_dir=scandir($this->app_const['PhotoTempLocation']);
            }
            else
                throw new Exception('檔案處理失敗！');
        }

        $this->printvar($tmp_photos_dir,"tmp_photos_dir:");
        foreach ($tmp_photos_dir as $key => $value) {
            $tmp_photo=explode('.',$value);
            if(((int)($tmp_photo[0]))){
                $tmp_photo=(int)($tmp_photo[0]);
                if(($this->time_stamp-$tmp_photo)>600){
                    unlink($this->app_const['PhotoTempLocation'].$value);
                    $this->printvar($this->app_const['PhotoTempLocation'].$value,"unlink:");
                }
            }
            
        }

        $cnt=0;
        $new_photo_path=$this->app_const['PhotoTempLocation'].$this->time_stamp.".".$cnt.".".str_replace("image/","",$img_info['mime']);
        while(file_exists($new_photo_path))
        {
            $cnt++;
            $new_photo_path=$this->app_const['PhotoTempLocation'].$this->time_stamp.".".$cnt.".".str_replace("image/","",$img_info['mime']);
        }

        if(!move_uploaded_file($_FILES[$type]['tmp_name'],$new_photo_path))
            throw new Exception('檔案處理失敗！');

        return $new_photo_path;

        // add to filesystem completed.
    }

    private function photo_to_upload($photo_tmp,$id)
    {
        rename($photo_tmp,$this->app_const['PhotoLocation'].$id);
    }

    private function proces_photo($name)
    {

    }

    private function printvar($var,$name=null)
    {
        if(!$this->debug_mode)
            return;

        if(isset($name))
            echo "<br><h2>".$name."</h2>";
        echo '<code>';
        var_dump($var);
        echo "</code><br>";
    }

    private function time_check()
    {
        if(time()<=$this->app_const['Timestamp_allowRegis'])
            throw new Exception("報名時間還沒到喔，報名將開始於：".date(DATE_RFC2822,$this->app_const['Timestamp_allowRegis'])."<br>現在時間是：".date(DATE_RFC2822,time()));

        if(time()>=$this->app_const['Timestamp_allowRegisEnd'])
            throw new Exception("報名時間已經結束了喔，報名已經結束於：".date(DATE_RFC2822,$this->app_const['Timestamp_allowRegisEnd'])."<br>現在時間是：".date(DATE_RFC2822,time()));
    }

}
