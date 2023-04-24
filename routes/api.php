<?php

use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('login', [ AuthController::class, 'login' ]);

Route::prefix('backoffice')->group(function() {

    Route::get('promotion-codes', [ PromotionController::class, 'index' ]);
    Route::get('promotion-codes/{id}', [ PromotionController::class, 'show' ]);
    Route::post('promotion-codes', [ PromotionController::class, 'store' ]);
});

Route::post('assign-promotion', [ PromotionController::class, 'assign' ])->middleware('auth:sanctum');
