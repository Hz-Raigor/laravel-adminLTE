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
Route::get('admin', function () {
    return view('admin');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
    Route::get('/login', 'LoginController@index');
    Route::get('/order', 'OrderController@index');
    Route::get('/guoyao', 'GuoyaoInterfaceController@index');
    Route::get('/guoyao/statistics', 'GuoyaoInterfaceController@statistics');
});
//Route::get('admin/order', 'admin\OrderController@index');

