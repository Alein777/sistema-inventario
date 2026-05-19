<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'nombre'       => $this->nombre,
            'contacto'     => $this->contacto,
            'telefono'     => $this->telefono,
            'email'        => $this->email,
            'tipo'         => $this->tipo,
            'pais'         => $this->pais, 
            'id_municipio' => $this->id_municipio,
            'estado'       => $this->estado,
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,

            // Retorna la relación del municipio si fue cargada con 'with' o 'load'
            'municipio'    => $this->whenLoaded('municipio', function() {
                return $this->municipio;
            }, $this->municipio),
        ];
    }
}
