<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkingController;


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

Route::group([
    'prefix' => 'auth'
], function () {
    
    Route::post('login', [AuthController::class, 'login'])->name('auth-login');
   
   Route::group(['middleware' => 'auth:api'], function() {
        Route::get('current', [AuthController::class, 'current'])->name('auth-current');
        Route::get('logout', [AuthController::class, 'logout'])->name('auth-logout');
       
    });

});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/parkings/{customer}/checkout', [ParkingController::class, 'checkout'])->name('parkings-checkout');  
    Route::apiResource('parkings', ParkingController::class);
});