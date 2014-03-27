<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',
	array(
		'as' => 'index',
		'uses' => 'intro@main')
	);

Route::get('/get/{type?}/{start_id?}',array(
		'as' => 'get',
		'uses' => 'intro@get')
	);

Route::get('/test',array(
		'as' => 'test',
		'uses' => 'regis@test')
	);

Route::get('/regis/{type}',
	array(
		'as' => 'regis0',
		'uses' => 'regis@form')
	);

Route::post('/regis',
	array(
		'as' => 'regis1',
		'uses' => 'regis@form_sent')
	);

Route::get('/modify',
	array(
		'as' => 'modify0',
		'uses' => 'regis@modify')
	);

Route::post('/modify',
	array(
		'as' => 'modify1',
		'uses' => 'regis@modify')
	);

Route::post('/preview/{type}',
	array(
		'as' => 'photo_upload',
		'uses' => 'regis@photo_preview')
	);
