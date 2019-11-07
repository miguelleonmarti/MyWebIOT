<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');

Route::post('/getStats', 'AjaxController@getStats');

Route::post('/getCharts', 'AjaxController@getCharts');

Route::get('/support', 'PagesController@support');

Route::get('/channelList', 'PagesController@channelList');

Route::delete('/channelList/{id}', 'PagesController@destroy');

Route::get('/newChannel', 'PagesController@newChannel');

Route::post('/newChannel', 'PagesController@create');

//////

Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');

Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');

// chart

Route::get('/chart/{id}', 'ChartController@index'); //prueba

// update

Route::post('/update', 'PagesController@update');


