<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Http\Resources\ProductoResource;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(
            Producto::with(['categoria', 'proveedor'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:250',
            'detalle'       => 'required|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'stock_minimo'  => 'required|integer|min:0',
            'id_categoria'  => 'required|exists:categorias,id',
            'id_proveedor'  => 'required|exists:proveedores,id',
            'imagen'        => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['imagen', '_method']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($data);
        return new ProductoResource($producto->load(['categoria', 'proveedor']));
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto->load(['categoria', 'proveedor']));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'        => 'sometimes|string|max:250',
            'detalle'       => 'sometimes|string',
            'precio_compra' => 'sometimes|numeric|min:0',
            'precio_venta'  => 'sometimes|numeric|min:0',
            'stock'         => 'sometimes|integer|min:0',
            'stock_minimo'  => 'sometimes|integer|min:0',
            'id_categoria'  => 'sometimes|exists:categorias,id',
            'id_proveedor'  => 'sometimes|exists:proveedores,id',
            'imagen'        => 'nullable|image|max:2048',
            'estado'        => 'sometimes|integer',
        ]);

        $data = $request->except(['imagen', '_method']);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && $producto->imagen !== 'default.jpg') {
                \Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);
        return new ProductoResource($producto->load(['categoria', 'proveedor']));
    }

    public function destroy(Producto $producto)
    {
        $producto->update(['estado' => 0]);
        return response()->json(['message' => 'Producto desactivado']);
    }
}