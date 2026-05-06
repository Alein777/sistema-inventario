<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MunicipioResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'nombre'          => $this->nombre,
            'id_departamento' => $this->id_departamento,
            'departamento'    => new DepartamentoResource($this->whenLoaded('departamento')),
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}