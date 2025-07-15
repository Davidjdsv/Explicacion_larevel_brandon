<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/productos_angular', [InventarioController::class, 'index']);
Route::post('/productos_angular', [InventarioController::class, 'store']);
Route::get('/productos_angular/{id}', [InventarioController::class, 'show']);
Route::delete('/productos_angular/{id}', [InventarioController::class, 'destroy']);

//Rutas para las ventas
Route::get("/ventas", [VentaController::class, "index"]);
Route::post("/ventas", [VentaController::class, "store"]);
Route::get("/ventas/{id}", [VentaController::class, "show"]);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
