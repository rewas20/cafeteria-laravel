<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusOrderController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleAuthController;
use Laravel\Socialite\Facades\Socialite;
 

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

Route::get('auth/google',[GoogleAuthController::class,'redirect'] )->name('google-auth');
Route::get('auth/google/call-back',[GoogleAuthController::class,'callbackgoogle']);

Route::resource('users', UserController::class);
Route::get('myprofile', [UserController::class,'myProfile' ])->name('user.myprofile');

// orders routes
Route::resource('orders', OrderController::class)->only(['index', 'store', 'destroy']);
Route::post('orders', [OrderController::class, 'filter'])->name('orders.filter');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::put('products/{product}/availability', [ProductController::class,'availability'])->name('products.availability');
Route::resource('carts', CartController::class);

Route::get('home/search', [HomeController::class, 'search'])->name('search');



Route::post('carts/plus/{increment}',[CartController::class,'increment'])->name('carts.increment');
Route::post('carts/minus/{decrement}',[CartController::class,'decrement'])->name('carts.decrement');


Route::resource('status-orders', StatusOrderController::class);
Route::resource('checks', CheckController::class);
Route::resource('order-products', OrderProductController::class);
Route::post('checks', [CheckController::class, 'filter'])->name('checks.filter');

Route::post('home', [HomeController::class, 'choose'])->name('home.choose');

Auth::routes([
    'verify' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



