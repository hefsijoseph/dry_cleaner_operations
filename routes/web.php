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
use App\Http\Controllers\EmployeePasswordResetController;

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

Auth::routes([
    'register' => 'False',
]);

Route::get('/login', function () {
    return redirect('/employees/login');
})->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource("roles", RoleController::class);
Route::middleware(['auth:employee'])->group(function () {
    Route::resource('roles', RoleController::class);
});


// Route::resource("addresses", AddressController::class);

Route::middleware(['auth:employee'])->group(function () {
    Route::resource('addresses', AddressController::class);
});

Route::middleware(['auth:employee'])->group(function () {
    Route::resource('employees', EmployeeController::class);
});

// Route::resource("customers", CustomerController::class);
Route::middleware(['auth:employee'])->group(function () {
    Route::resource('customers', CustomerController::class);
});


// Route::resource("items", ItemController::class);


Route::middleware(['auth:employee'])->group(function () {
    Route::resource('items', ItemController::class);
});


// Route::resource("orders", OrderController::class);
Route::middleware(['auth:employee'])->group(function () {
    Route::resource('orders', OrderController::class);
});


// Route::resource("payments", PaymentController::class);
Route::middleware(['auth:employee'])->group(function () {
    Route::resource('payments', PaymentController::class);
});


Route::get('get-customer-for-order/{order}', [PaymentController::class, 'getCustomerByOrder'])
    ->name('payments.get_customer');

Route::get('/employees/live-search', [EmployeeController::class, 'liveSearch'])
    ->name('employees.live-search');



  

Route::get('employee/forgot-password', [EmployeePasswordResetController::class, 'requestForm'])
    ->name('employee.password.request');

Route::post('employee/forgot-password', [EmployeePasswordResetController::class, 'sendEmail'])
    ->name('employee.password.email');

Route::get('employee/reset-password/{token}', [EmployeePasswordResetController::class, 'resetForm'])
    ->name('employee.password.reset');

Route::post('employee/reset-password', [EmployeePasswordResetController::class, 'updatePassword'])
    ->name('employee.password.update');
