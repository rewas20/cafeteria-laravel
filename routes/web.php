<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
Route::get('myprofile', [UserController::class,'myProfile' ])->name('user.myprofile');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::put('products/{product}/availability', [ProductController::class,'availability'])->name('products.availability');

Route::get('home/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');



Auth::routes([
    'verify' => true,
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
