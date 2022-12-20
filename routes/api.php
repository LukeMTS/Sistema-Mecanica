<?php

use App\Http\Controllers\VehicleController;
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
        Route::get('', 'getAll');
        Route::post('', 'store');
        Route::delete('{id}', 'destroy');
        Route::get('{id}', 'getCar');
        Route::put('{id}', 'update');
    });

Route::middleware('api')
    ->prefix('maintenances')
    ->controller(VehicleController::class)
    ->group(function () {
        Route::get('', 'getAll');
    });
