<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PetController;
use App\Http\Controllers\API\AuthController;

# Endpoint: http://127.0.0.1:8000/api/login
Route::post('/login', [AuthController::class, 'login']);

# Endpoint: http://127.0.0.1:8000/api/logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.token');


 Route::middleware('auth.token')->group(function () {
    # Endpoint: http://127.0.0.1:8000/api/pets/list
    Route::get('pets/list', [PetController::class, 'index']);

    # Endpoint: http://127.0.0.1:8000/api/pets/show/12
    Route::get('pets/show/{id}', [PetController::class, 'show']);

    # Endpoint: http://127.0.0.1:8000/api/pets/store
    Route::post('pets/store', [PetController::class, 'store']);

    # Endpoint: http://127.0.0.1:8000/api/pets/edit/12
    Route::put('pets/edit/{id}', [PetController::class, 'update']);

    # Endpoint: http://127.0.0.1:8000/api/pets/delete/12
    Route::delete('pets/delete/{id}', [PetController::class, 'destroy']);
});