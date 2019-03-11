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
//管理员
Route::resource('admins','AdminController');
//商家分类
Route::resource('shop_cates','ShopCateController');
//商家
Route::resource('shops','ShopController');
//店铺启动或禁用
Route::get('shops/status/{user}','ShopController@status')->name('shops.status');
//商家启动或禁用
Route::get('shops/statuss/{user}','ShopController@statuss')->name('shops.statuss');
//修改密码
Route::get('users/editpwd','UserController@editpwd')->name('users.editpwd');
Route::post('users/updatepwd','UserController@updatepwd')->name('users.updatepwd');
//菜品分类
Route::resource('menu_cates','MenuCateController');
//菜品分类默认
Route::get('menu_cates/status/{menu_cate}','MenuCateController@status')->name('menu_cates.status');
//菜品
Route::resource('menus','MenuController');
Route::get('menus/indexs/{menu_cate}','MenuController@indexs')->name('menus.indexs');
//菜品是否上架
Route::get('menus/status/{menu}','MenuController@status')->name('menus.status');
Route::get('menus/statuss/{menu}','MenuController@statuss')->name('menus.statuss');
//活动路由
Route::resource('activitys','ActivityController');
//订单
Route::get('order/index', 'OrderController@index')->name('order.index');
Route::get('order/show/{order}', 'OrderController@show')->name('order.show');
Route::get('order/status/{order}', 'OrderController@status')->name('order.status');
//7天订单统计
Route::get('order/orderWeek', 'OrderController@orderWeek')->name('order.orderWeek');
//7天订单统计
Route::get('order/orderMonth', 'OrderController@orderMonth')->name('order.orderMonth');
//抽奖活动
Route::get('event_members/index','EventMemberController@index')->name('event_members.index');
Route::get('event_members/show/{event}','EventMemberController@show')->name('event_members.show');
Route::get('event_members/create/{event}','EventMemberController@create')->name('event_members.create');
Route::get('event_members/result/{event}','EventMemberController@result')->name('event_members.result');