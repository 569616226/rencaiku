<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
////api 接口开发
//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', ['namespace' =>'App\Api\Controllers'],function ($api) {
//
//    //企业微信用户
//    $api->post('/user', 'UserController@getUser');
//    //企业推送接口
//    $api->post('/baoguandan', 'OrderController@getOrderB');
//
//});