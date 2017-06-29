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

Route::get('dashboard', function(){
  return view('dashboard');
});

Route::resource('stock', 'StocksController');

Route::resource('sales', 'SalesController');

Route::prefix('order')->group(function () {
  Route::get('{id}', 'SalesController@order')->where('id', '[0-9]+');
  Route::get('clear', 'SalesController@clearOrder');
  Route::get('view', 'SalesController@viewOrder');
  Route::get('remove/{id}', 'SalesController@deleteOrder')->where('id', '[0-9]+');
  Route::get('update/{id}/{qty}', 'SalesController@updateOrder')->where(['id' => '[0-9]+', 'qty' => '^[-+]?[0-9]+']);
  Route::get('get/{id}', 'SalesController@getStock')->where('id', '[0-9]+');
});




Route::get('view-sales', function(){
  return view('sale.view-sales');
});

Route::get('reports', function(){
  return view('report.reports');
});

Route::get('barcode', function(){
  echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("Shibaji Debnath", "C128",1,33) . '" alt="barcode"   />';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
