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
		'id'			=> '哀低',
		'regis_type'	=> '候選人類別',
		'type_data'		=> '詳細資料',
		'name'			=> '姓名',
		'sex'			=> '性別',
		'depart'		=> '系級',
		'grade'			=> '年級',
		'exp'			=> '經歷',
		'politics'		=> '政見',
		'phone'			=> '電話號碼',
		'email'			=> '電子信箱',
		'agree'			=> '同意與否',
		'code'			=> '修改碼',
		'photo'			=> '照片',
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
	   'depart'   => '/^\p{Han}{3,20}[一二三四五]年級$/u',
	   'exp'      => '/^.{2,300}$/us',
	   'politics' => '/^.{2,300}$/us',
	   'phone'    => '/^\d{10}$/',
	   'email'    => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
	   'agree'    => '/true/',
	),

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

	'PhotoAllowedSize' => 51200,

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
);

