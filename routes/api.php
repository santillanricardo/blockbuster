<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PeliculaController;
use App\Http\Controllers\Api\AuthController;

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Catálogo público (sin auth)
Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{pelicula}', [PeliculaController::class, 'show']);

// Protegidos con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/peliculas', [PeliculaController::class, 'store']);
    Route::put('/peliculas/{pelicula}', [PeliculaController::class, 'update']);
    Route::delete('/peliculas/{pelicula}', [PeliculaController::class, 'destroy']);
    Route::get('/user', fn(Request $r) => $r->user());
});