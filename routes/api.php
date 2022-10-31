<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;

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

Route::controller(AuthController::class)->prefix('users')->name('users')->group(function() {
    Route::post('/register', 'register');
    Route::post('/', 'login');
    Route::delete('/', 'logout');
});

Route::middleware('auth:sanctum')->controller(ItemController::class)->prefix('items')->name('items')->group(function() {
    Route::post('/', 'store');
    Route::delete('/{item}', 'destroy');
});
