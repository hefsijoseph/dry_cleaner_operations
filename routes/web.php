<?php
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Employee auth
Route::get('employees/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employees.login');
Route::post('employees/login', [EmployeeAuthController::class, 'login']);
Route::post('employees/logout', [EmployeeAuthController::class, 'logout'])->name('employees.logout');

Route::get('/employees', [EmployeeController::class, 'index'])
    ->middleware('auth:employee')
    ->name('employees.index');



// Customer auth
Route::get('customers/login', [CustomerAuthController::class, 'showLoginForm'])->name('customers.login');
Route::post('customers/login', [CustomerAuthController::class, 'login']);
Route::post('customers/logout', [CustomerAuthController::class, 'logout'])->name('customers.logout');

// Route::get('customers/dashboard', function () {
//     return "Customer Dashboard";
// })->middleware('auth:customers')->name('customers.dashboard');


Route::get('/customers', [CustomerController::class, 'index'])
    ->middleware('auth:customer')
    ->name('customers.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("roles", RoleController::class);
Route::resource("addresses", AddressController::class);
Route::middleware(['auth:employee'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});
Route::resource("customers", CustomerController::class);
Route::resource("items", ItemController::class);
ROute::resource("orders", OrderController::class);
Route::resource("payments", PaymentController::class);
Route::get('get-customer-for-order/{order}', [PaymentController::class, 'getCustomerByOrder'])
    ->name('payments.get_customer');

