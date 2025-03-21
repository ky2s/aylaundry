<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

// customers
Route::get('/customers/index', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/services/index', [ServiceController::class, 'index'])->name('services.index');


Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/store', [OrderController::class, 'store'])->name('orders.store');

// Route::get('/', function () {
//     return view('orders');
// });

// Route::get('/orders', [OrderController::class, 'index']);
