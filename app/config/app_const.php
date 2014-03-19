<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | col2name
    |--------------------------------------------------------------------------
    | 
    | 資料庫、填寫欄位變數對應中文名稱
    | 
    */

    'col2name' => array(
        'id'            => '哀低',
        'regis_type'    => '候選人類別',
        'type_data'     => '詳細資料',
        'name'          => '姓名',
        'sex'           => '性別',
        'depart'        => '系級',
        'grade'         => '年級',
        'exp'           => '經歷',
        'politics'      => '政見',
        'phone'         => '電話號碼',
        'email'         => '電子信箱',
        'agree'         => '同意與否',
        'code'          => '修改碼',
        'photo'         => '照片',
    ),

    /*
    |--------------------------------------------------------------------------
    | regis_field
    |--------------------------------------------------------------------------
    | 
    | 註冊時要有的欄位
    | 
    */

    'regis_field' => array(
        'photo'    => true,
        'name'     => true,
        'sex'      => true,
        'depart'   => true,
        'exp'      => true,
        'politics' => true,
        'phone'    => true,
        'email'    => true,
        'agree'    => true,
    ),

    /*
    |--------------------------------------------------------------------------
    | validationRegex
    |--------------------------------------------------------------------------
    | 
    | 每個欄位必須符合的正規表達式
    | 
    */

    'validationRegex' => array(
        'name'     => '/^([A-Za-z \x{4e00}-\x{9fff}]){2,20}$/u',
        'sex'      => '/^(1|0)$/',
        'depart'   => '/^\p{Han}{3,20}\d{2,3}級$/u', // old '/^\p{Han}{3,20}[一二三四五]年級$/u',
        'exp'      => '/^.{2,300}$/us',
        'politics' => '/^.{2,300}$/us',
        'phone'    => '/^\d{10}$/',
        'email'    => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
        'agree'    => '/true/',
    ),

    /*
    |--------------------------------------------------------------------------
    | validationRule
    |--------------------------------------------------------------------------
    | 
    | 使用 Laravel 內建的驗證功能，這是針對每個欄位的規則
    | 
    */

    'validationRule' => array(
        'name'     => array('required', 'regex:/^([A-Za-z \x{4e00}-\x{9fff}]){2,20}$/u'),
        'sex'      => array('required', 'regex:/^(1|0)$/'),
        'depart'   => array('required', 'regex:/^\p{Han}{3,20}\d{2,3}級$/u'),
        'exp'      => array('required', 'regex:/^.{2,300}$/us'),
        'politics' => array('required', 'regex:/^.{2,300}$/us'),
        'phone'    => array('required', 'regex:/^\d{10}$/'),
        'email'    => array('required', 'email'),
        'agree'    => 'accepted|required',
    ),

    /*
    |--------------------------------------------------------------------------
    | validationMsg
    |--------------------------------------------------------------------------
    | 
    | 使用 Laravel 內建的驗證功能，這是錯誤顯示訊息
    | 
    */

    'validationMsg' => array(
       'required'   => '這個欄位必填！',
       'accepted'   => '請勾選同意！',
       'email'      => '請填入正確的電子郵件！',
       'regex'      => '格式不正確！',
    ),

    /*
    |--------------------------------------------------------------------------
    | allowModify
    |--------------------------------------------------------------------------
    | 
    | 允許修改的欄位
    | 
    */

    'allowModify' => array(
        'photo'    => true,
        'name'     => false,
        'sex'      => false,
        'depart'   => false,
        'exp'      => true,
        'politics' => true,
        'phone'    => false,
        'email'    => false,
        'agree'    => false,

        // 'photo'    => true,
        // 'name'     => true,
        // 'sex'      => true,
        // 'depart'   => true,
        // 'exp'      => true,
        // 'politics' => true,
        // 'phone'    => true,
        // 'email'    => true,
        // 'agree'    => true,
    ),

    /*
    |--------------------------------------------------------------------------
    | regis_success_info
    |--------------------------------------------------------------------------
    | 
    | 申請成功時，提醒使用者的文字
    | 
    */
   
    'regis_success_info' => '申請成功！ 將在下方提供驗證碼提供日後修正，並且不要忘了把成績單繳至學生會辦公室！',

    /*
    |--------------------------------------------------------------------------
    | modify_success_info
    |--------------------------------------------------------------------------
    | 
    | 修改成功時，提醒使用者的文字
    | 
    */
   
    'modify_success_info' => '修改成功！ 請查照',

    /*
    |--------------------------------------------------------------------------
    | enable_recaptcha
    |--------------------------------------------------------------------------
    | 
    | 是否要啟用 google recaptcha 功能 (圖形驗證)
    | 
    */
    
    'enable_recaptcha' => false,

    /*
    |--------------------------------------------------------------------------
    | PhotoAllowedExt
    |--------------------------------------------------------------------------
    | 
    | 照片允許的類型
    | 
    */

    'PhotoAllowedType' => array('image/jpg','image/jpeg','image/png'),

    /*
    |--------------------------------------------------------------------------
    | PhotoAllowedSize
    |--------------------------------------------------------------------------
    | 
    | 照片允許的檔案大小 (Bytes)
    | 
    */

    'PhotoAllowedSize' => 102400,

    /*
    |--------------------------------------------------------------------------
    | PhotoLocation
    |--------------------------------------------------------------------------
    | 
    | 照片放置的位置，最後必須要有"/"
    | 
    */

    'PhotoLocation' => public_path()."/img/upload/",

    /*
    |--------------------------------------------------------------------------
    | PhotoTempLocation
    |--------------------------------------------------------------------------
    | 
    | 照片暫時放置的位置，最後必須要有"/"
    | 
    */

    'PhotoTempLocation' => public_path()."/img/upload/temp/",

    /*
    |--------------------------------------------------------------------------
    | Timestamp_allowRegis
    |--------------------------------------------------------------------------
    | 
    | 開始接受報名的時間
    | 
    */

    'Timestamp_allowRegis' => 1395014400,

    /*
    |--------------------------------------------------------------------------
    | Timestamp_allowRegisEnd
    |--------------------------------------------------------------------------
    | 
    | 結束接受報名的時間
    | 
    */

    'Timestamp_allowRegisEnd' => 1395910800,

    /*
    |--------------------------------------------------------------------------
    | photo_error_message
    |--------------------------------------------------------------------------
    | 
    | 圖片上傳錯誤的錯誤訊息
    | 
    */

    'photo_error_message' => array(

        'no_photo'                     => '圖片呢？',
        'photo_file_size_too_big'      => '檔案太大了喔',
        'photo_file_wrong_type'        => "無法辨識，或是錯誤的檔案格式",
        'can_not_process_photo'        => '檔案處理失敗！請稍候重試',
    ),

    /*
    |--------------------------------------------------------------------------
    | photo_error_message_prefix
    |--------------------------------------------------------------------------
    | 
    | 圖片上傳錯誤的錯誤訊息
    | 
    */

    'photo_error_message_prefix' => '錯誤：',
);

