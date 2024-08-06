<?php

use App\Http\Controllers\DashboardDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'dashboard-data'], function () {
    Route::get('/', [DashboardDataController::class, 'index']);
    Route::get('/{id}', [DashboardDataController::class, 'show']);
    Route::post('/', [DashboardDataController::class, 'store']);
    Route::put('/{id}', [DashboardDataController::class, 'update']);
    Route::delete('/{id}', [DashboardDataController::class, 'destroy']);
});
