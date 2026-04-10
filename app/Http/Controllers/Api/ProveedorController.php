<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Http\Resources\ProveedorResource;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        return ProveedorResource::collection(
            Proveedor::with('municipio')->where('estado', 1)->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'contacto'  => 'required|string|max:150',
            'telefono'  => 'required|string|max:20',
            'email'     => 'nullable|email|max:255',
            'tipo'      => 'nullable|string|max:100',
            'id_municipio' => 'nullable|exists:municipios,id',
        ]);

        $proveedor = Proveedor::create($request->all());
        return new ProveedorResource($proveedor->load('municipio'));
    }

    public function show(Proveedor $proveedor)
    {
        return new ProveedorResource($proveedor->load('municipio'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'nombre'    => 'sometimes|string|max:255',
            'contacto'  => 'sometimes|string|max:150',
            'telefono'  => 'sometimes|string|max:20',
            'email'     => 'nullable|email|max:255',
            'tipo'      => 'nullable|string|max:100',
            'id_municipio' => 'nullable|exists:municipios,id',
        ]);

        $proveedor->update($request->all());
        return new ProveedorResource($proveedor->load('municipio'));
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->update(['estado' => 0]);
        return response()->json(['message' => 'Proveedor desactivado']);
    }
}
