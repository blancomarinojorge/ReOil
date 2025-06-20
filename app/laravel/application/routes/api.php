<?php

use App\Http\Controllers\Api\ApiPickupResidueContainerController;
use App\Http\Controllers\Api\ApiRoutePickupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return Auth::user();
})->middleware('auth:sanctum')->name('user');


Route::middleware('auth:sanctum')->group(function () {
    Route::patch('/routes/{route}/pickups/order',
        [ApiRoutePickupController::class, 'updatePickupsOrder']
    )->name('routes.pickups.order');

    Route::get(
        '/pickups/{pickup}/containers/{container}/residues',
        [ApiPickupResidueContainerController::class, 'getResiduesByContainerAndPickup']
    )->name('pickups.containers.residues.index');

    Route::put('/pickups/{pickup}/containers/{container}',
        [ApiPickupResidueContainerController::class, 'updateContainerResidues']
    )->name('pickups.containers.residues.update');

    Route::delete('/pickups/{pickup}/containers/{container}',
        [ApiPickupResidueContainerController::class, 'destroy'])
        ->name('pickups.containers.residues.destroy');

});
