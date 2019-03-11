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
//用户登录
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
//接口
//店铺列表接口
Route::get('/api/business_list','Api\ApiController@businessList');
//店铺详情
Route::get('/api/business','Api\ApiController@business');
//用户登录
Route::post('/api/loginCheck','Api\ApiController@loginCheck');
//短信验证
Route::get('/api/sms','Api\ApiController@sms');
//用户注册
Route::post('/api/regist','Api\ApiController@regist');
//添加收货地址
Route::post('/api/addaddress','Api\ApiController@addAddress');
//收货地址列表
Route::get('/api/addressList','Api\ApiController@addressList');
//修改地址页面
Route::get('/api/address','Api\ApiController@address');
//保存修改
Route::post('/api/editAddress','Api\ApiController@editAddress');
// 保存购物车接口
Route::post('/api/addCart','Api\ApiController@addCart');
// 获取购物车数据接口
Route::get('/api/cart','Api\ApiController@cart');
// 添加订单
Route::post('/api/addOrder','Api\ApiController@addOrder');
//指定订单
Route::get('/api/order','Api\ApiController@order');
//订单列表
Route::get('/api/orderList','Api\ApiController@orderList');
// 修改密码
Route::post('/api/changePassword','Api\ApiController@changePassword');
// 忘记密码
Route::post('/api/forgetPassword','Api\ApiController@forgetPassword');