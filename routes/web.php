<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('loginAction', [App\Http\Controllers\LoginController::class, 'loginAction'])->name('loginAction');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('service', App\Http\Controllers\TypeOfServiceController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('order', App\Http\Controllers\TransOrderController::class);
    Route::get("print_struk/{id}", [App\Http\Controllers\TransOrderController::class, 'printStruk'])->name('print_struk');
    Route::get("report", [App\Http\Controllers\ReportController::class, 'report'])->name('report');
    Route::post("report", [App\Http\Controllers\ReportController::class, 'reportFilter'])->name('reportFilter');
});
