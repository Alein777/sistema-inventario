<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'nombre'        => $this->nombre,
            'detalle'       => $this->detalle,


            'precio_compra' => $this->precio_compra,
            'precio_venta'  => $this->precio_venta,
            'stock'         => $this->stock,
            'stock_minimo'  => $this->stock_minimo,
            'estado'        => $this->estado,
            'id_categoria'  => $this->id_categoria,
            'id_proveedor'  => $this->id_proveedor,


            'imagen' => $this->imagen,

            'imagen_url' => ($this->imagen && $this->imagen !== 'default.jpg')
                ? asset('storage/' . $this->imagen)
                : null,

            'categoria' => $this->whenLoaded('categoria'),
            'proveedor' => $this->whenLoaded('proveedor'),

        ];
    }
}