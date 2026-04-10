<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
{
    // Crear roles si no existen
    $admin    = Role::firstOrCreate(['name' => 'Administrador']);
    $empleado = Role::firstOrCreate(['name' => 'Empleado']);

    // Crear usuario administrador si no existe
    $user = User::firstOrCreate(
        ['email' => 'admin@gdastore.com'],
        [
            'name'     => 'Administrador',
            'password' => bcrypt('password'),
            'estado'   => 1,
        ]
    );

    $user->assignRole($admin);
}
}