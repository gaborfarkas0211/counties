<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
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

Route::controller(CountyController::class)->group(function () {
    Route::get('counties', 'getCounties');
    Route::get('/counties/{county}/cities', 'showCities');
});
Route::post('counties/{county}/city', [CityController::class, 'store']);
