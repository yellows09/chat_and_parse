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
