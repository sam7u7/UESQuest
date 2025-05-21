<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EncuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('encuesta')->insert([
            [
                'id_usuario' => 1,
                'id_grupo' => 1,
                'titulo' => 'encuesta 1',
                'objetivo' => 'Encuesta 1',
                'indicacion' => 'Encuesta 1',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'created_by'  => 'prueba@prueba.com',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
            [
                'id_usuario' => 2,
                'id_grupo' => 2,
                'titulo' => 'encuesta 2',
                'objetivo' => 'Encuesta 2',
                'indicacion' => 'Encuesta 2',
                'fecha_inicio' => Carbon::now(),
                'fecha_fin' => Carbon::now(),
                'created_by'  => 'prueba@prueba.com',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
                'deleted_at'  => null,
            ],
        ]);
    }
}
