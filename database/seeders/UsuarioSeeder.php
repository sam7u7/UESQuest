<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('usuario')->insert([
            [
                'id_rol'      => 1, // Asegúrate que el rol con id 1 exista (por ejemplo, "Administrador")
                'nombre'      => 'Juan',
                'apellido'    => 'Pérez',
                'telefono'    => '5551234567',
                'correo'      => 'juan.perez@example.com',
                'password'    => Hash::make('password123'), // encripta la contraseña
                'created_by'  => 'prueba@prueba.com', // ID del creador, puedes ajustarlo según tus datos
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
            [
                'id_rol'      => 2, // Por ejemplo, "Usuario"
                'nombre'      => 'Ana',
                'apellido'    => 'Gómez',
                'telefono'    => '5559876543',
                'correo'      => 'ana.gomez@example.com',
                'password'    => Hash::make('secret456'),
                'created_by'  => 'prueba@prueba.com',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
        ]);
    }
}
