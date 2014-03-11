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
		'uses' => 'modify@form')
	);

Route::post('/modify',
	array(
		'as' => 'modify1',
		'uses' => 'modify@form_sent')
	);
