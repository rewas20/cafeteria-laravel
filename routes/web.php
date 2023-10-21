<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusOrderController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::put('products/{product}/availability', [ProductController::class,'availability'])->name('products.availability');
Route::get('/products/search', 'ProductController@search')->name('products.search');

Route::resource('status-orders', StatusOrderController::class);

Auth::routes([
    'verify' => true,
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
