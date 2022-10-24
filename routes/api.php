<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecommendController;

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

Route::post('/orders', [OrderController::class, 'order']);
Route::get('/recommend_items', [RecommendController::class, 'recommend_items']);
Route::get('/aiueo/{id}', [RecommendController::class, 'aiueo']);