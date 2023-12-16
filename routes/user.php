<?php

use App\Http\Controllers\Api\V1\User\UserPreferencesController;
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


Route::group(['prefix' => 'v1/users', 'middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'preferences'], function () {
        Route::post('/', [UserPreferencesController::class, 'store']);
        Route::get('/', [UserPreferencesController::class, 'index']);
    });
});
