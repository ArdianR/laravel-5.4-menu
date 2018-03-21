<?php

// use App\User;

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
Route::get('/home', 'HomeController@index')->name('home');

/*start route group admin*/
Route::group(['middleware' => ['admin']], function () {
    Route::get('/pop/index1','PopController@index1');
});
/*end route group admin*/

/*start hq route group*/ 
Route::group(['middleware' => ['hq']], function () {
    Route::get('/pop/index2','PopController@index2');
    Route::get('/pop/list2','PopController@list2');
	Route::get('/pop/show2/{id}','PopController@show2');
	Route::get('/pop/show4/{id}','PopController@show4');
   	Route::post('/pop/approve/{id}','PopController@approve');
   	Route::get('/pop/history4/{id}','PopController@history4');
   	Route::get('/pop/history5/{id}','PopController@history5');
});
/*end hq route group*/

/*start route group hr*/
Route::group(['middleware' => ['hr']], function () {
	Route::get('/pop/index3','PopController@index3'); 
	Route::get('/pop/create3/{id}','PopController@create3');
	Route::get('/pop/edit3/{id}','PopController@edit3');
	Route::get('/pop/edit4/{id}','PopController@edit4');
	Route::match(['put', 'patch'], '/pop/update3/{id}','PopController@update3');
	Route::get('/pop/move/{id}','PopController@move');
	Route::get('/pop/list3','PopController@list3');
	Route::get('/pop/show3/{id}','PopController@show3');
	Route::post('/pop/store3','PopController@store3');
	Route::get('/pop/history3/{id}','PopController@history3');
});
/*end route group hr*/

/*start route group move*/
Route::group(['middleware' => ['move']], function () {
	Route::get('/move/index','MoveController@index'); 
	Route::get('/move/create/{id}','MoveController@create');
	Route::post('/move/store','MoveController@store');
	Route::get('/move/list','MoveController@list');
	Route::get('/move/show/{id}','MoveController@show');
});
/*end route group move*/

/*start route group admin*/
Route::group(['middleware' => 'admin'], function() {
	Route::resource('/group','GroupController');
	Route::resource('/area','AreaController');
	Route::resource('/user','UserController');
	Route::resource('/status','StatusController');
	Route::resource('/product','ProductController');
	Route::resource('/store','StoreController');
	Route::get('/store/create1/{id}','StoreController@create1');
	Route::post('/store/productStore','StoreController@productStore')->name('store.productStore');
	Route::get('/store/productShow/{id}','StoreController@productShow')->name('store.productShow');
	Route::get('/store/product/{id}/Edit','StoreController@productEdit')->name('store.productEdit');
	Route::put('/store/productUpdate/{id}','StoreController@productUpdate')->name('store.productUpdate');
	Route::delete('/store/productDestroy/{id}','StoreController@productDestroy')->name('store.productDestroy');
	Route::resource('/pop','PopController');
});
/*end route group admin*/




// Route::group(['middleware' => ['auth']], function () {

// Route::get('/home', 'HomeController@index')->name('home');






// Route::get('/pop/indexHq','PopController@indexHq')->name('pop.indexHq');

// Route::get('/pop/indexHr','PopController@indexHr')->name('pop.indexHr');
// Route::get('/pop/createHr/{id}','PopController@createHr')->name('pop.createHr');
// Route::post('/pop/storeHr','PopController@storeHr');
// Route::get('/pop/list','PopController@list');
// Route::get('/pop/showPop/{id}','PopController@showPop')->name('pop.showPop');


// Route::get('/pop/createArea','PopController@createArea')->name('pop.createArea');
// Route::get('/pop/storeArea','PopController@storeArea')->name('pop.storeArea');


// });

