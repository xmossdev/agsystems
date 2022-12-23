<?php

use Illuminate\Support\Facades\Route;
use App\Filters\Test;
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

//Route::get('/', function () {
//
//    $a = \App\Models\Warehouse::query()->filter([
//        '\App\Filters\Test:id'
//    ])->get();
//
//    dd('test', $a);
//});


Route::get('', [\App\Http\Controllers\WarehouseController::class, 'index']);
