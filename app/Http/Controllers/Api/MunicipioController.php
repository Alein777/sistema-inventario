<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Municipio;
use App\Http\Resources\MunicipioResource;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        return MunicipioResource::collection(
            Municipio::with('departamento')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|string|max:100',
            'id_departamento' => 'required|exists:departamentos,id',
        ]);

        $municipio = Municipio::create($request->all());
        return new MunicipioResource($municipio->load('departamento'));
    }

    public function show(Municipio $municipio)
    {
        return new MunicipioResource($municipio->load('departamento'));
    }

    public function update(Request $request, Municipio $municipio)
    {
        $request->validate([
            'nombre'          => 'sometimes|string|max:100',
            'id_departamento' => 'sometimes|exists:departamentos,id',
        ]);

        $municipio->update($request->all());
        return new MunicipioResource($municipio->load('departamento'));
    }

    public function destroy(Municipio $municipio)
    {
        
        if ($municipio->clientes()->exists() || $municipio->proveedores()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar: el municipio tiene clientes o proveedores asociados'
            ], 409);
        }

        $municipio->delete();
        return response()->json(['message' => 'Municipio eliminado']);
    }
}