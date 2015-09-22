<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'homepage', 'uses' => 'HomepageController@homepage']);

Route::get('/profile', ['as' => 'profile', 'uses' => 'HomepageController@profile']);
Route::post('/profile/save', ['as' => 'profileSave', 'uses' => 'HomepageController@profileSave']);

Route::get('/inquiry/index', ['as' => 'inquiries', 'uses' => 'InquiriesController@index']);
Route::get('/inquiry/private', ['as' => 'inquiriesPrivate', 'uses' => 'InquiriesController@privateIndex']);
Route::post('/inquiry/store', ['as' => 'inquiryStore', 'uses' => 'InquiriesController@store']);
Route::get('/inquiry/delete/{id}', ['as' => 'inquiriesDestroy', 'uses' => 'InquiriesController@destroy']);

Route::get('/news/index', ['as' => 'news', 'uses' => 'NewsController@index']);

Route::get('metro/{id}', 'MetroController@city');












## Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

## Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

## Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

## Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');









## Social routes
Route::get('auth/github', 'Auth\Social\GitHubAuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\Social\GitHubAuthController@handleProviderCallback');

Route::get('auth/twitter', 'Auth\Social\TwitterAuthController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\Social\TwitterAuthController@handleProviderCallback');

Route::get('auth/facebook', 'Auth\Social\FacebookAuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\Social\FacebookAuthController@handleProviderCallback');

Route::get('auth/vkontakte', 'Auth\Social\VkontakteAuthController@redirectToProvider');
Route::get('auth/vkontakte/callback', 'Auth\Social\VkontakteAuthController@handleProviderCallback');

Route::get('auth/yandex', 'Auth\Social\YandexAuthController@redirectToProvider');
Route::get('auth/yandex/callback', 'Auth\Social\YandexAuthController@handleProviderCallback');

Route::get('auth/odnoklassniki', 'Auth\Social\OdnoklassnikiAuthController@redirectToProvider');
Route::get('auth/odnoklassniki/callback', 'Auth\Social\OdnoklassnikiAuthController@handleProviderCallback');

Route::get('auth/google', 'Auth\Social\GoogleAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\Social\GoogleAuthController@handleProviderCallback');












## Admin routes
Route::group(['prefix' => 'admin'], function()
{
    ## Auth routes
    Route::get('login', ['as' => 'admin.login', 'uses' =>'Admin\Auth\AuthController@getLogin']);
    Route::post('login', 'Admin\Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'admin.logout', 'uses' =>'Admin\Auth\AuthController@getLogout']);

    ## Admin Models
    Route::group(['middleware' => 'admin'], function()
    {
        Route::get('/', ['as' => 'admin', 'uses' =>'Admin\IndexController@index']);

        Route::resource('inquiries', 'Admin\InquiriesController');
        Route::resource('news', 'Admin\NewsController');
        Route::resource('cars', 'Admin\CarsController');
        Route::resource('cities', 'Admin\CitiesController');
        Route::resource('metro', 'Admin\MetroController');
        Route::resource('users', 'Admin\UsersController');
        Route::resource('administrators', 'Admin\AdministratorsController');
    });
});

