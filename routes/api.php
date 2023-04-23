<?php

use App\Http\Controllers\PromotionController;
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

Route::prefix('backoffice')->group(function() {

    Route::get('promotion-codes', [ PromotionController::class, 'index' ]);
    Route::get('promotion-codes/{id}', [ PromotionController::class, 'show' ]);
    Route::post('promotion-codes', [ PromotionController::class, 'store' ]);
});

Route::post('assign-promotion', [ PromotionController::class, 'assign' ]);
