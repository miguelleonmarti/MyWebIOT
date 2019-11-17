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
Route::post('/suggestion', 'PagesController@suggestion');

Route::get('/', 'PagesController@index');

Route::post('/getStats', 'AjaxController@getStats');

Route::get('/getCharts/{id}', 'AjaxController@getCharts');

Route::get('/support', 'PagesController@support');

Route::get('/channelList', 'PagesController@channelList');

Route::delete('/channelList/{id}', 'PagesController@destroy');

Route::delete('/userList/{id}', 'PagesController@destroyUser');

Route::delete('/suggestionList/{id}', 'PagesController@destroySuggestion');

Route::get('/newChannel', 'PagesController@newChannel');

Route::post('/newChannel', 'PagesController@create');

Route::get('/indexWebService', 'PagesController@webService');

// Registration Controller

Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

// Session Controller

Route::get('/login', 'SessionsController@create');

Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');

// Chart Controller

Route::get('/chart/{id}', 'ChartController@index'); //prueba

Route::get('/refresh/{id}', 'ChartController@refresh');

// update

Route::post('/update', 'PagesController@update');

Route::get('/webService', 'WebServiceController@index');

Route::get('/webService2/{day}/{month}/{year}', 'WebServiceController@index2');
