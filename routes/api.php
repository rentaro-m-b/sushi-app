<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;


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

Route::controller(AuthController::class)->prefix('auth')->name('auth')->group(function() {
    Route::post('/register', 'register');
    Route::post('/', 'login');
    Route::delete('/', 'logout');
    Route::get('/authUser', 'authUserFetch')->middleware('auth:sanctum');
});


Route::controller(ItemController::class)->prefix('items')->name('items')->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'store');
});

Route::controller(CategoryController::class)->prefix('categories')->name('categories')->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'store');
    Route::put('/{category}', 'update');
});
