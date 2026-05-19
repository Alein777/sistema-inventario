<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Limpiar el caché de permisos de Spatie (Obligatorio)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Definir la lista de permisos que utiliza el Sidebar y los botones
        $permisos = [
            // Dashboard
            'ver-dashboard',

            // Productos
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'desactivar-productos',
            'ajustar-stock',

            // Categorías
            'ver-categorias',

            // Proveedores
            'ver-proveedores',

            // Movimientos
            'ver-movimientos',

            // Usuarios / Administración
            'gestionar-usuarios',
        ];

        // 3. Crear los permisos en la base de datos si no existen
        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso, 'guard_name' => 'web']);
        }

        // 4. Crear los Roles del Sistema
        $roleAdmin    = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $roleBodega   = Role::firstOrCreate(['name' => 'Bodeguero', 'guard_name' => 'web']);
        $roleVendedor = Role::firstOrCreate(['name' => 'Vendedor', 'guard_name' => 'web']);

        // 5. Asignar Permisos a cada Rol
        // El administrador se queda con todo el catálogo
        $roleAdmin->syncPermissions($permisos);

        // El bodeguero solo ve inventario y ajusta existencias, no administra usuarios
        $roleBodega->syncPermissions([
            'ver-dashboard',
            'ver-productos',
            'crear-productos',
            'editar-productos',
            'ajustar-stock',
            'ver-categorias',
            'ver-proveedores',
            'ver-movimientos'
        ]);

        // El vendedor solo tiene permisos de lectura básicos
        $roleVendedor->syncPermissions([
            'ver-dashboard',
            'ver-productos',
            'ver-categorias'
        ]);

        // 6. Asignar el Rol de Administrador al usuario principal
        // Buscamos tu usuario por el correo que vimos en la pantalla
        $adminUser = User::where('email', 'admin@gdastore.com')->first();

        if ($adminUser) {
            $adminUser->assignRole($roleAdmin);
            $this->command->info('Rol de Administrador asignado con éxito a admin@gdastore.com');
        } else {
            $this->command->warn('No se encontró el usuario admin@gdastore.com. Recuerda registrarlo primero.');
        }
    }
}
