<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PricesController;
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
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers/update', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers/destroy/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers_search', [CustomerController::class, 'search'])->name('customers.search');


// price
Route::get('/prices/get', [PricesController::class, 'getPrice'])->name('prices.get');

// service
Route::get('/services/index', [ServiceController::class, 'index'])->name('services.index');


Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
// Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');
