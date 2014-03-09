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

Route::get('/',function(){
	return View::make('info');
});

Route::get('/regis/{type}',
	array(
		'as' => 'step0',
		'uses' => 'regis@form')
	);

Route::post('/regis/{type}',
	array(
		'as' => 'step1',
		'uses' => 'regis@form_sent')
	);

Route::get('/modify',
	array(
		'as' => 'modify0',
		'uses' => 'modify@form')
	);

Route::post('/modify',
	array(
		'as' => 'modify1',
		'uses' => 'regis@form_sent')
	);
