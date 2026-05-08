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
            'imagen'        => $this->imagen ? asset('storage/' . $this->imagen) : null,
            'precio_compra' => $this->precio_compra,
            'precio_venta'  => $this->precio_venta,
            'stock'         => $this->stock,
            'stock_minimo'  => $this->stock_minimo,
            'estado'        => $this->estado,
            'id_categoria'  => $this->id_categoria,
            'id_proveedor'  => $this->id_proveedor,
            'categoria'     => new CategoriaResource($this->whenLoaded('categoria')),
            'proveedor'     => new ProveedorResource($this->whenLoaded('proveedor')),
        ];
    }
}