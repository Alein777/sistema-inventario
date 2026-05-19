<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Forzamos la limpieza de la tabla de usuarios por si acaso
        DB::statement('TRUNCATE TABLE users CASCADE');

        // Crear roles si no existen
        $admin    = Role::firstOrCreate(['name' => 'Administrador']);
        $empleado = Role::firstOrCreate(['name' => 'Empleado']);

        // Creamos el usuario pasando la contraseña limpia
        // (Laravel la encriptará automáticamente por el cast 'hashed' de tu modelo)
        $user = User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@gdastore.com',
            'password' => 'password', // <-- Pruébalo sin el bcrypt() debido al cast 'hashed'
            'estado'   => 1,
        ]);

        $user->assignRole($admin);
    }
}
