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
            return response()->json(['message' => 'Producto no encontrado']);
        } else {
            return response()->json($item);
        }
    }
}
