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

Route::get('/', function () {
    return view('welcome');
});

//首頁
Route::get('index', ['as' => 'index', 'uses' => 'AuthController@show'])->name('index');

//註冊入口
Route::get('register_entrance', 'RegisterController@register_entrance_show');

//註冊
Route::group(['prefix' => 'register'], function() {

    Route::get('{val_id}', 'RegisterController@register_show'); //判斷註冊的身分

    Route::post('create_tenant', 'AuthController@register_create_tenant'); //註冊房客

    Route::post('create_landlord', 'AuthController@register_create_landlord'); //註冊房東
});

Route::get('/getmail/{user_id}',  'MailController@getmail');//收到使用者確認信件(並開通身分)

//登入入口
Route::get('login_entrance', 'LoginController@login_entrance_show');

//登入
Route::group(['prefix' => 'login'], function() {

    Route::get('{val_id}', 'LoginController@login_show'); //判斷登入的身分

    Route::post('find', 'AuthController@login'); //登入房客

    Route::get('{val_id}/error', 'LoginController@login_one_error'); //登入失敗1次

    Route::get('{val_id}/error/error', 'LoginController@login_two_error'); //登入失敗2次

    Route::get('{val_id}/error/error/error', 'LoginController@login_three_error'); //登入失敗3次

    Route::get('{val_id}/error/error/error/error', 'LoginController@login_over_three_error'); //登入失敗超過3次

});

//房東 - 刊登房屋 - view
Route::group(['prefix' => 'publish'], function() {

    Route::get('/publish_landlord_info',  'PublishHouseController@index')->name('publish_step_one'); //刊登房屋(step1)

    //Route::get('/publish_house_info',  'PublishHouseController@index_2')->name('publish_step_two'); //測試用
});