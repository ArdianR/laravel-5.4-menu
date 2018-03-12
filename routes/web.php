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
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/group','GroupController');
Route::resource('/area','AreaController');
Route::resource('/user','UserController');
Route::resource('/status','StatusController');
Route::resource('/store','StoreController');
Route::get('/store/productCreate/{id}','StoreController@productCreate')->name('store.productCreate');
Route::post('/store/productStore','StoreController@productStore')->name('store.productStore');
Route::get('/store/productShow/{id}','StoreController@productShow')->name('store.productShow');
Route::resource('/pop','PopController');
Route::resource('/product','ProductController');
Route::get('/popstore','PopController@popStore');
});
