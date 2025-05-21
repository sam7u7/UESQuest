<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GrupoMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('grupo_meta')->insert([
            [
                'nombre_grupo' => 'grupo1',
                'descripcion_grupo' => 'Grupo 1',
                'created_by'  => 'prueba@prueba.com',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
            [
                'nombre_grupo' => 'grupo2',
                'descripcion_grupo' => 'Grupo 2',
                'created_by'  => 'prueba@prueba.com',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
        ]);
    }
}
