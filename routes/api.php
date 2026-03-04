<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\VehiculoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('contactos')->group(function () {
    Route::get('/', [ContactoController::class, 'getAllContactos']);
    Route::get('/{id}', [ContactoController::class, 'getContactoById']);
    Route::post('/', [ContactoController::class, 'createContacto']);
    Route::put('/{id}', [ContactoController::class, 'updateContacto']);
    Route::delete('/{id}', [ContactoController::class, 'deleteContacto']);
});

Route::prefix('vehiculos')->group(function () {
    Route::get('/', [VehiculoController::class, 'getAllVehiculos']);
    Route::get('/{id}', [VehiculoController::class, 'getVehiculoById']);
    Route::post('/', [VehiculoController::class, 'createVehiculo']);
    Route::put('/{id}', [VehiculoController::class, 'updateVehiculo']);
    Route::delete('/{id}', [VehiculoController::class, 'deleteVehiculo']);
});
