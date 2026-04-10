<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Resources\CategoriaResource;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return CategoriaResource::collection(Categoria::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias',
            'estado' => 'sometimes|integer',
        ]);

        $categoria = Categoria::create($request->all());
        return new CategoriaResource($categoria);
    }

    public function show(Categoria $categoria)
    {
        return new CategoriaResource($categoria);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255|unique:categorias,nombre,'.$categoria->id,
            'estado' => 'sometimes|integer',
        ]);

        $categoria->update($request->all());
        return new CategoriaResource($categoria);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->update(['estado' => 0]);
        return response()->json(['message' => 'Categoría desactivada']);
    }
}