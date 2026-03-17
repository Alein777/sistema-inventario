<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $admin    = Role::create(['name' => 'Administrador']);
        $empleado = Role::create(['name' => 'Empleado']);

        // Crear usuario administrador
        $user = User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@gdastore.com',
            'password' => bcrypt('password'),
            'estado'   => 1,
        ]);

        $user->assignRole($admin);
    }
}