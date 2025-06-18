<?php

use App\Http\Controllers\Api\ApiRoutePickupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth:sanctum')->name('user');


Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/routes/{route}/pickups/order', [ApiRoutePickupController::class, 'updatePickupsOrder'])->name('routes.pickups.order');
});
