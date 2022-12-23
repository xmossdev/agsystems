<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\WarehouseController;
use \App\Http\Controllers\ItemController;

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

Route::controller(WarehouseController::class)->prefix('warehouses')->group(function () {
    Route::get('', 'index');
    Route::post('store','store');
    Route::get('show/{id}', 'show');
    Route::put('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});

Route::controller(ItemController::class)->prefix('items')->group(function () {
    Route::get('', 'index');
    Route::post('store','store');
    Route::get('show/{id}', 'show');
    Route::put('update/{id}', 'update');
    Route::delete('delete/{id}', 'destroy');
});
