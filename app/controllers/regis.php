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
        $this->view_var['candidate']=candidate::where('id', '=', 16)->take(1)->get();
        return View::make('regisOK',$this->view_var);

        //return hash('crc32b','邱冠喻0970900813資訊科學與工程學系三年級');
    }

    public function form($type)
    {
        try {
            //$form = Form::model($user, array('route' => array('user.update', $user->id)));
            if($type!=0 && $type!=2 && $type!=3)
                throw new Exception("Wrong type!");
            if($type==0)
                $this->view_var['NumberOfCandidate']=2;
            else
                $this->view_var['NumberOfCandidate']=1;

            $this->view_var['type']=$type;
            
            return View::make('form',$this->view_var);
        } catch (Exception $e) {
            $this->view_var['message']=$e->getMessage();
            return View::make('failed',$this->view_var);
        }
    }

    public function form_sent()
    {
        try {
            $canditates=Input::get('candidate');

            $id=0;
            foreach ($canditates as $key => $value) {
                
                $value['regis_type']=$key;
                $value['type_data']=$id;

                $id=$this->candidate_valid_and_add($value);
                $photo_tmp=$this->photo_valid_and_to_tmp($key);
                $this->photo_to_upload($photo_tmp,$id);
            }

            return View::make('regisOK',$this->view_var);
        } catch (Exception $e) {
            $this->view_var['message']=$e->getMessage();
            return View::make('failed',$this->view_var);
        }
    }

    public function preview_img(){

    }

    private function candidate_valid_and_add($candidate){

        // Validate start :

        $validReg=$this->app_const['validationRegex'];
        $this->printvar($candidate,"candidate before validate");
        foreach($validReg as $key => $reg){
            if(!isset($candidate[$key]))
                $candidate[$key]='';
            if(preg_match($reg,$candidate[$key])==0){
                $error_str=$this->app_const['col2name'][$key].'的輸入有誤：「'.$candidate[$key]."」";
                if(!$this->debug_mode)
                    throw new Exception($error_str);
                else
                    $this->printvar($error_str,"Exception!!");;
            }
        }
        $this->printvar($candidate,"candidate after validate");

        // Validate completed.
        
        // the user has agreed
        if($candidate['agree']==='true')
            $candidate['agree']=1;
        else
            throw new Exception("請勾選同意！");

        // process textarea content:
        $candidate['politics']=nl2br($candidate['politics']);
        $candidate['exp']=nl2br($candidate['exp']);

        // generate code:
        $candidate['code']=hash('crc32b', $candidate['name'].$candidate['depart'].$candidate['phone'].$candidate['email']);

        $this->printvar($candidate,"candidate final");

        // add to db :

        $candidate_db = candidate::create($candidate);
        $candidate_db->save(); 

        $this->view_var['candidate'][]=$candidate_db;
        $this->printvar($candidate_db,'candidate_db');
        return $candidate_db->id;
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
        // $tmp=explode(".",$photo_tmp);
        // $ext=end($tmp);
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

}
