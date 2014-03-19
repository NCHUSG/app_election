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

            $this->view_var['enable_recaptcha']=$this->app_const['enable_recaptcha'];
            
            $this->view_var['type']=$type;
            $this->view_var['enabled_field']=$this->app_const['regis_field'];
            $this->view_var['target_route']='regis1';
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
                $this->valid($value,$this->app_const['regis_field'],$this->view_var['const']['type2name'][$key]);


                if(isset($value['photo_tmp']))
                    $photo_tmp[$key]=$this->photo_valid_and_to_tmp($value['photo_tmp'],true);
                else
                    $photo_tmp[$key]=$this->photo_valid_and_to_tmp($key);
            }

            foreach ($canditates as $key => $value) {
                $value['regis_type']=$key;
                $value['type_data']=$id;

                $field=$this->app_const['regis_field'];
                $field['regis_type']=true;
                $field['type_data']=true;

                $id=$this->candidate_add_or_modify($field,$value);
                $this->photo_to_upload($photo_tmp[$key],$id);
                $this->view_var['candidate'][]=candidate::find($id);
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
                    
                    $this->view_var['NumberOfCandidate']=1;
                    $this->view_var['enable_recaptcha']=false;
                    $this->view_var['type']=$this->view_var['candidate']->regis_type;
                    $this->view_var['enabled_field']=$this->app_const['allowModify'];
                    $this->view_var['target_route']='modify1';
                    $this->view_var['form_title']="資料修改：".$this->view_var['const']['type2name'][$this->view_var['candidate']->regis_type]." - ".$this->view_var['candidate']->name;

                    $this->printvar($this->view_var,"view_var");

                    return View::make('form',$this->view_var);
                    break;
                case 2:
                    $candidate_db=candidate::whereRaw("code = '".Input::get('code')."' and id = ".Input::get('id'));

                    $this->printvar($candidate_db,"candidate_db");

                    if($candidate_db->count() == 0)
                        throw new Exception("請勿亂來！");

                    $candidate=Input::get('candidate');
                    foreach ($candidate as $key => $value) {
                        $theKey=$key;
                    }
                    $candidate=$candidate[$theKey];
                    
                    $this->valid($candidate,$this->app_const['allowModify']);
                    $candidate_db=$candidate_db->first();
                    $id=$this->candidate_add_or_modify($this->app_const['allowModify'],$candidate,$candidate_db);

                    try {
                        if(isset($candidate['photo_tmp']))
                            $photo_tmp=$this->photo_valid_and_to_tmp($candidate['photo_tmp'],true);
                        else
                            $photo_tmp=$this->photo_valid_and_to_tmp($theKey);
                        $this->photo_to_upload($photo_tmp,Input::get('id'));
                    } catch (Exception $e) {}

                    $this->view_var['candidate'][]=candidate::find($id);
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

    public function photo_preview($type)
    {
        try {
            return $this->photo_valid_and_to_tmp($type);
        } catch (Exception $e) {
            return $this->view_var['const']['photo_error_message_prefix'].$e->getMessage();
        }
    }

    private function valid($toBe_valid,$field,$errMsg_prefix="")
    {
        $rule=array();
        foreach ($field as $key => $value) {
            if($value && isset($this->app_const['validationRule'][$key])){
                $rule[$key]=$this->app_const['validationRule'][$key];
            }
        }

        $this->printvar($rule,"rule");
        $this->printvar($field,"field");

        $validator = Validator::make($toBe_valid,$rule,$this->app_const['validationMsg']); //幹，太神威了，我之前那些是在寫三小
        
        $this->printvar($validator->fails(),"validator_failed");
        $this->printvar($validator->messages(),"validator_messages");

        if($validator->fails()){
            $err_obj=$validator->messages();
            $err_obj->setFormat(':key.:message');
            
            $err_arr=$err_obj->all();
            $err_msg=$errMsg_prefix."的資料有問題：<br>";

            $this->printvar($err_arr,"err_arr");

            foreach ($err_arr as $key => $value) {
                $tmp=explode('.',$value);
                $err_msg.= "欄位「".$this->app_const['col2name'][$tmp[0]]."」的資料有誤：".$tmp[1]."<br>說明：".$this->view_var['const']['fieldDocExample'][$tmp[0]]."<br>";
            }
            $this->printvar($err_msg,"err_msg");
            throw new Exception($err_msg);
        }
    }

    private function candidate_add_or_modify($field,$candidate_data,$candidate_db=null){
        $data=array();
        foreach ($field as $key => $value) {
            if($value && isset($candidate_data[$key])){
                $data[$key]=$candidate_data[$key];
            }
        }

        $this->printvar($candidate_data,"candidate final");

        // add to db or update db:
        if(isset($candidate_db)){
            $candidate_db->update($data);
        }
        else{
            // generate code:
            $data['code']=hash('crc32b', $candidate_data['name'].$candidate_data['depart'].$candidate_data['phone'].$candidate_data['email'].$this->time_stamp);

            $candidate_db = candidate::create($data);
        }
        $candidate_db->save(); 

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

    private function photo_valid_and_to_tmp($name_or_file,$is_file=false)
    {
        //get error message array
        $err_meg=$this->app_const['photo_error_message'];

        //for path param
        
        if($is_file){
            if(preg_match("/^\d{10,}\.\d$/",$name_or_file)!==1)
                throw new Exception($err_meg['can_not_process_photo']);

            if(!file_exists($this->app_const['PhotoTempLocation'].$name_or_file))
                throw new Exception($err_meg['can_not_process_photo']);

            return $name_or_file;
        }

        //for name (input's name, $_FILES's key) param

        if(!isset($_FILES[$name_or_file]))
            throw new Exception($err_meg['no_photo']);

        if($_FILES[$name_or_file]['size']<16)
            throw new Exception($err_meg['no_photo']);

        if($_FILES[$name_or_file]['size']>$this->app_const['PhotoAllowedSize'])
            throw new Exception($err_meg['photo_file_size_too_big']);

        if(!in_array($_FILES[$name_or_file]['type'],$this->app_const['PhotoAllowedType']))
            throw new Exception($err_meg['photo_file_wrong_type']);

        $img_info=getimagesize($_FILES[$name_or_file]['tmp_name']);

        if($img_info===false)
            throw new Exception($err_meg['photo_file_wrong_type']);

        if(!in_array($img_info['mime'],$this->app_const['PhotoAllowedType']))
            throw new Exception($err_meg['photo_file_wrong_type']);

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
                throw new Exception($err_meg['can_not_process_photo']);
        }

        //$this->printvar($tmp_photos_dir,"tmp_photos_dir:");
        foreach ($tmp_photos_dir as $key => $value) {
            $tmp_photo=explode('.',$value);
            if(((int)($tmp_photo[0]))){
                $tmp_photo=(int)($tmp_photo[0]);
                if(($this->time_stamp-$tmp_photo)>600){
                    unlink($this->app_const['PhotoTempLocation'].$value);
                    //$this->printvar($this->app_const['PhotoTempLocation'].$value,"unlink:");
                }
            }
            
        }

        $cnt=0;
        $new_photo_path=$this->time_stamp.".".$cnt;
        while(file_exists($new_photo_path))
        {
            if($cnt>=10)
                throw new Exception($err_meg['can_not_process_photo']);
            $cnt++;
            $new_photo_path=$this->time_stamp.".".$cnt;
        }

        if(!move_uploaded_file($_FILES[$name_or_file]['tmp_name'],$this->app_const['PhotoTempLocation'].$new_photo_path))
            throw new Exception($err_meg['can_not_process_photo']);

        return $new_photo_path;
        // add to filesystem completed.
    }

    private function photo_to_upload($photo_tmp,$id)
    {
        rename($this->app_const['PhotoTempLocation'].$photo_tmp,$this->app_const['PhotoLocation'].$id);
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
