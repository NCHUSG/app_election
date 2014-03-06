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

Route::get('/regis/{type}',
	array(
		'as' => 'step1',
		'uses' => 'regis@form')
	);
