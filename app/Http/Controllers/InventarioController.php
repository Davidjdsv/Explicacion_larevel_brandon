<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

class InventarioController extends Controller
{
    //
    public function index(){
        // Tomar Todo de Inventario para su uso
        $item = Inventario::all();
        return response()->json($item);
    }

    public function show($id){
        $item = Inventario::find($id);
        if($item){
            return response()->json(['message' => 'Producto no encontrado'], 404);
        } else {
            return response()->json($item);
        }
    }

    public function destroy($id){
        $item = Inventario::find($id);
        if($item){
            $item->delete();
            return response()->json(['message' => 'Producto Eliminado']);
        } else {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
    }

    public function store(Request $request){
        $validate = $request->validate([
            //Párametros required/nullable/tipo_dato/longitud_string(si es uno)
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'disponible' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'cantidad' => 'required|integer'
        ]);

        $item = Inventario::create($validate);

        // Retorna mensaje desde la app
        return response() -> json([
            'message' => 'Producto creado correctamente',
            'item' => $item 
        ], 201); 
    }
}

// Ahora nos vamos a la API