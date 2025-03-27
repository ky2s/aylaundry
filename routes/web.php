<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// kasir
Route::middleware(['auth', 'role:admin'])->group(function () {
    // kasir management
    Route::resource('kasir', App\Http\Controllers\EmployeesController::class);

    // service
    Route::resource('services', ServicesController::class);

    // report
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});

// customers
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/edit/{customer}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::post('/customers/update/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
Route::post('/customers/destroy/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('/customers_search', [CustomerController::class, 'search'])->name('customers.search');

// orders
Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('/home', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
// Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::get('/orders/{order}/receipt', [OrderController::class, 'receipt'])->name('orders.receipt');


// price
Route::get('/prices/get', [PricesController::class, 'getPrice'])->name('prices.get');


