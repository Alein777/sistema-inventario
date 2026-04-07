<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nombre', 'contacto', 'telefono', 
        'email', 'tipo', 'id_municipio', 'estado'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }
}
