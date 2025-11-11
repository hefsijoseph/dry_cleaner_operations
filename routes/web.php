<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource("addresses", AddressController::class);
Route::resource("employees", EmployeeController::class);
Route::resource("customers", CustomerController::class);
Route::resource("items", ItemController::class);
ROute::resource("orders", OrderController::class);

