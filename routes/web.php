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
Route::get('/store/product/{id}/Edit','StoreController@productEdit')->name('store.productEdit');
Route::put('/store/productUpdate/{id}','StoreController@productUpdate')->name('store.productUpdate');
Route::delete('/store/productDestroy/{id}','StoreController@productDestroy')->name('store.productDestroy');


// Route::resource('/pop','PopController');
Route::get('/pop/indexHq','PopController@indexHq')->name('pop.indexHq');

Route::get('/pop/indexHr','PopController@indexHr')->name('pop.indexHr');
Route::get('/pop/createHr/{id}','PopController@createHr')->name('pop.createHr');
Route::post('/pop/storeHr','PopController@storeHr');

Route::get('/pop/showAreaHq/{id}','PopController@showAreaHq')->name('pop.showAreaHq');
Route::get('/pop/createArea','PopController@createArea')->name('pop.createArea');
Route::get('/pop/storeArea','PopController@storeArea')->name('pop.storeArea');
Route::resource('/product','ProductController');

});
