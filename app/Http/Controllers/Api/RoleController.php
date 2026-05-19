<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Listar todos los roles con sus respectivos permisos asignados
    public function index()
    {
        return response()->json([
            'roles' => Role::with('permissions')->get(),
            'all_permissions' => Permission::all() // Para enviarle los checkboxes a React
        ]);
    }

    // Guardar un nuevo Rol creado desde React
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'required|array' // Array de nombres de permisos (strings)
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        // Sincroniza los checkboxes marcados
        $role->syncPermissions($request->permissions);

        return response()->json(['message' => 'Rol creado correctamente', 'role' => $role]);
    }

    // Actualizar un rol existente (cambiarle nombre o permisos)
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'required|array'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return response()->json(['message' => 'Rol actualizado correctamente']);
    }

    // Eliminar un Rol
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->name === 'Administrador') {
            return response()->json(['message' => 'No puedes eliminar el rol principal'], 422);
        }

        $role->delete();
        return response()->json(['message' => 'Rol eliminado']);
    }
}
