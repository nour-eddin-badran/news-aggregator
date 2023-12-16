<?php

use App\Http\Controllers\Api\V1\Index\SourceController;
use App\Http\Controllers\Api\V1\Index\CategoryController;
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


Route::group(['prefix' => 'v1/indexes', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/sources', [SourceController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
});
