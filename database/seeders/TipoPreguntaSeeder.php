<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TipoPreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipo_pregunta')->insert([
            [
                'tipo_pregunta'=>'Polítomica',
                'indicacion'=>'Seleccione  que considere correcta',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Dicotómica',
                'indicacion'=>'Seleccione una de las dos opciones',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Multiple',
                'indicacion'=>'Seleccione las respuestas que considere correctas',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Ranking',
                'indicacion'=>'Ordene de manera jerarquice según considere correcto ',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Escala',
                'indicacion'=>'Seleccione el grado de intensidad',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Likert',
                'indicacion'=>'Seleccione la que considere mas acertada con su opinion',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Numerica',
                'indicacion'=>'Seleccione del 1 al 10 que tan satisfecho se encuentra',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
            [
                'tipo_pregunta'=>'Mixta',
                'indicacion'=>'Seleccione la respuesta correcta o responda con sus propias palabras ',
                'created_by'=>'prueba@prueba.com',
                'created_at'=> carbon::now(),
                'updated_at'=> carbon::now()
            ],
        ]);
    }
}
