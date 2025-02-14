<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;

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

Route::get('/', [ItemController::Class, 'index'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class,'authenticate'])->middleware('guest');
Route::get('/logout', [AuthController::class,'logout'])->middleware('auth');

Route::view('/register', 'register')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');

Route::get('/item/{id}', [ItemController::Class, 'show'])->middleware('auth');

Route::get('/admin-page', [ItemController::Class, 'adminView'])->middleware(['must-admin', 'auth']);

Route::get('/admin-page/add-item', [ItemController::Class,'addItem'])->middleware('must-admin', 'auth');
Route::post('/admin-page/item', [ItemController::Class, 'store'])->middleware('must-admin', 'auth');

Route::get('/admin-page/update-item/{id}', [ItemController::Class,'updateItem'])->middleware('must-admin', 'auth');
Route::put('/admin-page/update/{id}', [ItemController::Class, 'update'])->middleware('must-admin', 'auth');

Route::get('/admin-page/delete-item/{id}', [ItemController::Class,'delete'])->middleware('must-admin', 'auth');
Route::delete('/admin-page/destroy/{id}', [ItemController::Class,'destroy'])->middleware('must-admin', 'auth');

Route::get('/cart', [ItemController::Class,'getCart'])->middleware( 'auth');
Route::get('/add-to-cart/{id}', [ItemController::Class, 'addToCart'])->middleware('auth');
Route::get('/increase-cart/{id}', [ItemController::Class, 'increaseCart'])->middleware('auth');
Route::get('/decrease-cart/{id}', [ItemController::Class, 'decreaseCart'])->middleware('auth');

// Route::view('/checkout', 'checkout')->middleware('auth');
Route::post('/checkout/{invoiceNumber}', [invoiceController::Class,'checkout'])->middleware( 'auth');
Route::get('/checkout', [InvoiceController::Class,'generate'])->middleware( 'auth');