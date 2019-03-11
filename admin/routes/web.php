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

//管理员登录
Route::get('login', 'LoginController@create')->name('login');
Route::post('login', 'LoginController@store')->name('login');
Route::get('logout', 'LoginController@destroy')->name('logout');
//根据超级管理员
Route::group(['middleware' => ['role:超级管理员']], function () {
//管理员
    Route::resource('admins','AdminController');
//权限
    Route::resource('permissions','PermissionController');
//角色
    Route::resource('roles','RoleController');
//页面
    Route::resource('nvas','NvaController');
});
//根据会员
Route::group(['middleware' => ['role:会员管理员|超级管理员']], function () {
//会员
    Route::get('member/index', 'MemberController@index')->name('member.index');
    Route::get('member/show/{member}', 'MemberController@show')->name('member.show');
    Route::get('member/status/{member}', 'MemberController@index')->name('member.status');
});
//根据商家
Route::group(['middleware' => ['role:商家管理员|超级管理员']], function () {
//商家
    Route::resource('users','UserController');
    Route::get('shops/statuss/{user}','ShopController@statuss')->name('shops.statuss');
//商家分类
    Route::resource('shop_cates','ShopCateController');
//店铺
    Route::resource('shops','ShopController');
    Route::get('shops/status/{user}','ShopController@status')->name('shops.status');
});
//根据会员
Route::group(['middleware' => ['role:活动管理员|超级管理员']], function () {
//活动
    Route::resource('activitys','ActivityController');
//抽奖活动
    Route::resource('events','EventController');
//活动奖品
    Route::resource('event_prizes','EventPrizeController');
//活动报名
    Route::get('event_members/index','EventMemberController@index')->name('event_members.index');
    Route::get('event_members/show/{event}','EventMemberController@show')->name('event_members.show');
//开始抽奖
    Route::get('event/status/{event}','EventController@status')->name('event.status');
    //抽奖结果
    Route::get('event/result/{event}','EventController@result')->name('event.result');
});
