<?php

use App\Http\Controllers\InventarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/inventario', [InventarioController::class, 'index']);
Route::post('/inventario', [InventarioController::class, 'store']);
Route::get('/inventario/{id}', [InventarioController::class, 'show']);
Route::delete('invetario/{id}', [InventarioController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
