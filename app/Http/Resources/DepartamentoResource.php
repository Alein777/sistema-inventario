<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MunicipioResource;

class DepartamentoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'nombre'     => $this->nombre,
            'municipios' => MunicipioResource::collection($this->whenLoaded('municipios')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}