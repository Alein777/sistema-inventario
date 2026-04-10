<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movimiento;
use App\Http\Resources\MovimientoResource;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index()
    {
        return MovimientoResource::collection(
            Movimiento::with(['producto', 'user'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $producto = \App\Models\Producto::findOrFail($request->id_producto);
        $stock_anterior = $producto->stock;

        if ($request->tipo === 'entrada') {
            $stock_nuevo = $stock_anterior + $request->cantidad;
        } else {
            if ($stock_anterior < $request->cantidad) {
                return response()->json(['message' => 'Stock insuficiente'], 422);
            }
            $stock_nuevo = $stock_anterior - $request->cantidad;
        }

        $producto->update(['stock' => $stock_nuevo]);

        $movimiento = Movimiento::create([
            'id_producto' => $request->id_producto,
            'id_user' => auth()->id(),
            'tipo' => $request->tipo,
            'cantidad' => $request->cantidad,
            'stock_anterior' => $stock_anterior,
            'stock_nuevo' => $stock_nuevo,
            'motivo' => $request->motivo,
        ]);

        return new MovimientoResource($movimiento->load(['producto', 'user']));
    }

    public function show(Movimiento $movimiento)
    {
        return new MovimientoResource($movimiento->load(['producto', 'user']));
    }

    public function update(Request $request, Movimiento $movimiento)
    {
        $request->validate([
            'motivo' => 'sometimes|string|max:255',
        ]);

        $movimiento->update($request->all());
        return new MovimientoResource($movimiento->load(['producto', 'user']));
    }

    public function destroy(Movimiento $movimiento)
    {
        $movimiento->delete();
        return response()->json(['message' => 'Movimiento eliminado']);
    }
}
