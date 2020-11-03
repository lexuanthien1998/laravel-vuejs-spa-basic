<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('stories','APIControllerStory@index');
Route::prefix('stories')->group(function (){
    Route::get('show/{id}','APIControllerStory@show');
    Route::post('store','APIControllerStory@store');
    Route::get('edit/{id}','APIControllerStory@edit');
    Route::post('update/{id}','APIControllerStory@update');
    Route::delete('delete/{id}','APIControllerStory@destroy');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login','APIUserController@login');
    Route::post('register','APIUserController@register');
    Route::get('current_user', 'APIUserController@currentUser'); //lấy thông tin user đang đăng nhập gửi qua bên api
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'APIUserController@logout');
});