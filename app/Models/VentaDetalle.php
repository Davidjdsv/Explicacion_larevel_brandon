<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $table = "detalle_ventas";
    public $timestamps = false;
    protected $fillable = [
        "venta_id",
        "producto_id",
        "cantidad",
        "precio_unitario"
    ];

    public function ventas(){
        return $this -> belongsTo(Ventas::class, "venta_id");
    }
}
