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

Route::get('dashboard', 'ReportsController@dashboard')->middleware('auth');

Route::get('type/{id}/{type?}', 'SettingsController@setType')->middleware('auth');


Route::resource('stock', 'StocksController');

Route::resource('sales', 'SalesController');
Route::get('return/{id}', 'SalesController@returnShow');

Route::resource('reports','ReportsController');

Route::resource('settings', 'SettingsController');

Route::get('users', function(){
  return view('user.users');
})->middleware('auth');

Route::prefix('order')->group(function () {
  Route::get('{id}', 'SalesController@order')->where('id', '[0-9]+');
  Route::get('return/{sid}/{id}', 'SalesController@orderReturn')->where(['sid'=>'[0-9]+', 'id'=> '[0-9]+']);
  Route::get('return/remove/{sid}/{id}', 'SalesController@deleteOrderReturn')->where(['sid'=>'[0-9]+', 'id'=> '[0-9]+']);

  Route::get('clear', 'SalesController@clearOrder');
  Route::get('view', 'SalesController@viewOrder');
  Route::get('remove/{id}', 'SalesController@deleteOrder')->where('id', '[0-9]+');
  Route::get('update/{id}/{qty}', 'SalesController@updateOrder')->where(['id' => '[0-9]+', 'qty' => '^[-+]?[0-9]+']);
  Route::get('get/{id}', 'SalesController@getStock')->where('id', '[0-9]+');
});


Route::get('excel/{start?}/{end?}', 'ReportsController@excel')->middleware('auth');


use \Milon\Barcode\DNS1D;

Route::get('barcode', function(){
  //echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("Shibaji Debnath", "C128",1,33) . '" alt="barcode"   />';


  $d = new DNS1D();
  echo $d->get("7", "C128",1,33);


})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
