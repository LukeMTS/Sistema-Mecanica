<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\VehicleController;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')
    ->prefix('cars')
    ->controller(VehicleController::class)
    ->group(function () {
        Route::get('users/{vehicleId}', 'getAll');
        Route::post('', 'store');
        Route::delete('{id}', 'destroy');
        Route::get('{id}', 'getCar');
        Route::put('{id}', 'update');
        Route::get('user/{userId}', 'getCarsByUserId');
    });

Route::middleware('api')
    ->prefix('maintenances')
    ->controller(MaintenanceController::class)
    ->group(function () {
        Route::get('users/{userId}', 'getAll');
        Route::post('', 'store');
        Route::delete('{id}', 'destroy');
        Route::get('{id}', 'getMaintenance');
        Route::put('{id}', 'update');
    });

Route::middleware('api')
    ->prefix('home')
    ->controller(HomeController::class)
    ->group(function () {
        Route::get('next-maintenances', 'getNextMaintenances');
    });
