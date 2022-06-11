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

Route::get('/orderForm', function () {
    return view('orderForm');
})->name('orderForm');

Route::post('/sendOrderData', [\App\Http\Controllers\orderFormController::class, 'sendOrder'])->name('sendOrderData');

Route::get('/sendPhoto', function (\App\Services\Telegram $telegram) {
    $telegram->sendPhoto(1867965641, '1.jpeg');
});


Route::get('/mapTest', function (\App\Services\GetUserInformation $information) {
    $hash = \Illuminate\Support\Facades\Hash::make(123);
    var_dump($information->getAll());
})->middleware('IpCheck');

Route::get('/loginForm',function(){
    return view('login');
});

Route::post('/login',\App\Http\Controllers\Auth\LoginController::class)->name('login');
//t.uwhyBs4jk9qs6JqOdUaxTiH7Sv6CmBi24HsOSZrjxyb0FrzXZOk4sX3YJGi6aCwjZ74gce_gzb6AEM2wL097iw
