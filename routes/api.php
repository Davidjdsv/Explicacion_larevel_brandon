<?php

use App\Http\Controllers\InventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/productos_angular', [InventarioController::class, 'index']);
Route::post('/productos_angular', [InventarioController::class, 'store']);
Route::get('/productos_angular/{id}', [InventarioController::class, 'show']);
Route::delete('/productos_angular/{id}', [InventarioController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
