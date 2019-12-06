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

use App\Http\Controllers\SocialController;

Route::post('/suggestion', 'PagesController@suggestion');

Route::get('/', 'PagesController@index');

Route::post('/getStats', 'AjaxController@getStats');

Route::get('/getCharts/{id}', 'AjaxController@getCharts');

Route::get('/support', 'PagesController@support');

Route::get('/channelList', 'PagesController@channelList');

Route::delete('/channelList/{id}', 'PagesController@destroy');

Route::delete('/userList/{id}', 'PagesController@destroyUser');

Route::delete('/suggestionList/{id}', 'PagesController@destroySuggestion');

Route::delete('/productList/{id}', 'PagesController@destroyProduct');

Route::get('/newChannel', 'PagesController@newChannel');

Route::post('/newChannel', 'PagesController@create');

Route::post('/newProduct', 'PagesController@createProduct');

Route::get('/indexWebService', 'PagesController@webService');

// Registration Controller

Route::get('/register', 'RegistrationController@create');

Route::post('/register', 'RegistrationController@store');

// Session Controller

Route::get('/login', ['as' => 'login', 'uses' => 'SessionsController@create']);

Route::post('/login', 'SessionsController@store');

Route::get('/logout', 'SessionsController@destroy');

// Chart Controller

Route::get('/chart/{id}', 'ChartController@index');

Route::get('/product/{id}', 'ChartController@productUpdate');

Route::put('/productUpdate/{id}', 'ChartController@update');

Route::get('/refresh/{id}', 'ChartController@refresh');

// update

Route::post('/update', 'PagesController@update');

Route::get('/webService', 'WebServiceController@index');

Route::get('/webService2/{day}/{month}/{year}', 'WebServiceController@index2');

// BuyController

Route::get('/buyProduct', 'BuyController@create');

// SocialController

Route::get('/social', 'SocialController@create');

Route::post('/social', 'SocialController@getMessages');

Route::get('/newMessage', 'SocialController@createMessage');

Route::post('/newMessage', 'SocialController@newMessage');

// FollowerController

Route::get('/friends', 'FollowerController@create');

// ProfileController

Route::get('/profile', 'ProfileController@create');

// MemberController

Route::get('/members', 'MemberController@create');

Route::get('/membersChannels', 'MemberController@createMembersChannels');

Route::post('/membersChannels', 'MemberController@getChannels');

Route::post('/follow/{id}', 'MemberController@follow');

Route::delete('/unfollow/{id}', 'MemberController@unfollow');

// WebstoreController: cart

Route::delete('/remove', 'WebstoreController@removeFromCart');

Route::post('/add/{id}', 'WebstoreController@addToCart');

Route::delete('/destroy', 'WebstoreController@destroyCart');

// PaypalController

Route::get('/checkout', 'PaypalController@payWithpaypal');

Route::get('/status', 'PaypalController@getPaymentStatus');
