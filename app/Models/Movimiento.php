<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'id_producto', 'id_user', 'tipo', 
        'cantidad', 'stock_anterior', 'stock_nuevo', 'motivo'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
