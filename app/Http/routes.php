<?php

/* Application routes ----------------------------------------------------------------------------------------------- */

Route::get('/', ['as' => 'homepage', 'uses' => 'HomepageController@homepage']);
Route::get('/vars', ['as' => 'vars', 'uses' => 'HomepageController@vars']);
Route::post('/feedback', ['as' => 'feedbackSave', 'uses' => 'HomepageController@feedbackSave']);

Route::get('/profile', ['as' => 'profile', 'uses' => 'HomepageController@profile']);
Route::post('/profile/save', ['as' => 'profileSave', 'uses' => 'HomepageController@profileSave']);

Route::get('/inquiry/index', ['as' => 'inquiries', 'uses' => 'InquiriesController@index']);
Route::get('/inquiry/private', ['as' => 'inquiriesPrivate', 'uses' => 'InquiriesController@privateIndex']);
Route::get('/inquiry/show/{id}', ['as' => 'inquiryShow', 'uses' => 'InquiriesController@show']);
Route::post('/inquiry/store', ['as' => 'inquiryStore', 'uses' => 'InquiriesController@store']);
Route::match(['get', 'post'], '/inquiry/search', ['as' => 'inquirySearch', 'uses' => 'InquiriesController@search']);
Route::get('/inquiry/delete/{id}', ['as' => 'inquiriesDestroy', 'uses' => 'InquiriesController@destroy']);

Route::get('/news/index', ['as' => 'news', 'uses' => 'NewsController@index']);
Route::get('/news/show/{id}', ['as' => 'newsShow', 'uses' => 'NewsController@show']);

Route::get('/page/show/{id}', ['as' => 'pageShow', 'uses' => 'PagesController@show']);

Route::get('metro/{id}', 'MetroController@city');

Route::get('carmodels/{id}', 'CarmodelsController@car');




/* Authentication routes -------------------------------------------------------------------------------------------- */
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




/* Social routes ---------------------------------------------------------------------------------------------------- */
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

Route::get('auth/mailru', 'Auth\Social\MailRuAuthController@redirectToProvider');
Route::get('auth/mailru/callback', 'Auth\Social\MailRuAuthController@handleProviderCallback');

Route::get('auth/google', 'Auth\Social\GoogleAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\Social\GoogleAuthController@handleProviderCallback');




/* Admin routes ----------------------------------------------------------------------------------------------------- */
Route::group(['prefix' => 'admin'], function()
{
    ## Auth routes
    Route::get('login', ['as' => 'admin.login', 'uses' =>'Admin\Auth\AuthController@getLogin']);
    Route::post('login', 'Admin\Auth\AuthController@postLogin');
    Route::get('logout', ['as' => 'admin.logout', 'uses' =>'Admin\Auth\AuthController@getLogout']);

    ## Models routes
    Route::group(['middleware' => 'admin'], function()
    {
        Route::get('/', ['as' => 'admin', 'uses' =>'Admin\IndexController@index']);

        Route::get('settings', ['as' => 'admin.settings', 'uses' =>'Admin\SettingsController@index']);
        Route::post('settings', ['as' => 'admin.settings.save', 'uses' =>'Admin\SettingsController@save']);

        Route::resource('inquiries', 'Admin\InquiriesController');
        Route::resource('pages', 'Admin\PagesController');
        Route::resource('blocks', 'Admin\BlocksController');
        Route::resource('news', 'Admin\NewsController');
        Route::resource('faq', 'Admin\FaqController');
        Route::resource('cars', 'Admin\CarsController');
        Route::resource('carmodels', 'Admin\CarmodelsController');
        Route::resource('cities', 'Admin\CitiesController');
        Route::resource('metro', 'Admin\MetroController');
        Route::resource('users', 'Admin\UsersController');
        Route::resource('administrators', 'Admin\AdministratorsController');
    });
});

