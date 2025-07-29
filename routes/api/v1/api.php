<?php

use App\Product1\Dog;
use App\Contracts\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AnimalServiceController;
use App\Http\Controllers\Api\V1\Products\ProductSyncController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test',AnimalServiceController::class);

Route::post('/sync-from-bigcommerce', ProductSyncController::class);