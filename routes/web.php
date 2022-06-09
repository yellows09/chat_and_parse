<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/parseData', [\App\Http\Controllers\ParseNewsController::class, 'ParseNews'])->name('parseData');

Route::get('/orderForm',function(){
    return view('orderForm');
})->name('orderForm');

Route::post('/sendOrderData',[\App\Http\Controllers\orderFormController::class,'sendOrder'])->name('sendOrderData');

Route::get('/sendPhoto',function(\App\Services\Telegram $telegram){
    $telegram->sendPhoto(1867965641,'1.jpeg');
});

Route::get('/mapTest',function (){
    $res = \Illuminate\Support\Facades\Http::get('https://api.nasa.gov/neo/rest/v1/feed',[
        'start_date' => '2015-09-07',
        'end_date' => '2015-09-08',
        'api_key' => 'YEzbiAhP9xXT5DuCwKRzlHQIFIUIxbdxDxJgGFws'
    ]);
    $res = json_decode($res);
    var_dump($res);
});
Route::get('/testTin',[\App\Http\Controllers\TinkoffController::class,'getAccounts']);

//t.uwhyBs4jk9qs6JqOdUaxTiH7Sv6CmBi24HsOSZrjxyb0FrzXZOk4sX3YJGi6aCwjZ74gce_gzb6AEM2wL097iw
