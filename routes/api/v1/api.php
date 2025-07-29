<?php

use App\Http\Controllers\Api\V1\AnimalServiceController;
use App\Http\Controllers\Api\V1\Products\ProductSyncController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', AnimalServiceController::class);

Route::post('/sync-from-bigcommerce', ProductSyncController::class);
