<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas; // importar el modelo Ventas
use App\Models\Inventario; // importar el modelo Inventario
use App\Models\VentaDetalle; // importar el modelo VentasDetalle
use Illuminate\Support\Facades\DB;

class VentaController extends Controller{
    public function index(){
        $ventas = Ventas::with('detalles')->get();
        return response()->json($ventas);
    }
    public function store(Request $request){
        $data = $request->validate([
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        ]);
        DB::beginTransaction();

    try {// Validar que los productos existan y tengan suficiente cantidad
        $total=0;
        foreach($data['productos'] as $item) {// Validar que el producto exista
            $producto = Inventario::findOrFail($item['producto_id']);
            if ($producto->cantidad < $item['cantidad']) {
                throw new \Exception('Cantidad insuficiente para el producto: ' . $producto->nombre);
            }
            $total += $producto->precio * $item['cantidad'];
        }

        $venta = Ventas::create(['fecha' => now(), 'total' => $total]);// Crear la venta
        foreach ($data['productos'] as $item) {
            $producto = Inventario::findOrFail($item['producto_id']);
            VentaDetalle::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio
            ]);
            $producto->cantidad -= $item['cantidad'];// Actualizar la cantidad del producto en inventario
            $producto->save();
        }
        DB::commit();

        return response()->json([
                'message' => 'Venta registrada correctamente',// Mensaje de éxito
                'venta' => $venta->load('detalles')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}