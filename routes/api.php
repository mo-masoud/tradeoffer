<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SliderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('sliders', SliderController::class)->only(['index']);

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
