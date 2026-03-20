<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre', 'detalle', 'imagen',
        'precio_compra', 'precio_venta',
        'stock', 'stock_minimo',
        'id_categoria', 'id_proveedor', 'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'id_producto');
    }
}