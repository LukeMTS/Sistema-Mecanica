<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\VehicleController;
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

Route::get('/', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/register/vehicles', [VehicleController::class, 'add']);
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/edit/vehicle/{id}', [VehicleController::class, 'edit']);

    Route::get('/register/maintenance', [MaintenanceController::class, 'add']);
    Route::get('/maintenances', [MaintenanceController::class, 'index']);
    Route::get('/edit/maintenance/{id}', [MaintenanceController::class, 'edit']);

    Route::get('/home', [HomeController::class, 'index']);
});
