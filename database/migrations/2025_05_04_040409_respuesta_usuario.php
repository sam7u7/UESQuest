<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('respuesta_usuario', function (Blueprint $table) {
           $table->id();
           $table->foreignId('id_realiza_encuesta')->references('id')->on('realiza_encuesta');
           $table->foreignId('id_pregunta')->references('id')->on('tipo_pregunta');
           $table->foreignId('id_respuesta')->references('id')->on('tipo_respuesta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        schema::dropIfExists('respuesta_usuario');
    }
};
