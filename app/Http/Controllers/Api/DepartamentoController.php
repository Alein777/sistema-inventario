<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Http\Resources\DepartamentoResource;
use App\Http\Resources\MunicipioResource;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        return DepartamentoResource::collection(Departamento::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:departamentos',
        ]);

        $departamento = Departamento::create($request->all());
        return new DepartamentoResource($departamento);
    }

    public function show(Departamento $departamento)
    {
        return new DepartamentoResource($departamento->load('municipios'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:departamentos,nombre,'.$departamento->id,
        ]);

        $departamento->update($request->all());
        return new DepartamentoResource($departamento);
    }

    public function destroy(Departamento $departamento)
    {
        
        if ($departamento->municipios()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar: el departamento tiene municipios asociados'
            ], 409);
        }

        $departamento->delete();
        return response()->json(['message' => 'Departamento eliminado']);
    }

   
    public function municipios(Departamento $departamento)
    {
        return MunicipioResource::collection($departamento->municipios);
    }
}