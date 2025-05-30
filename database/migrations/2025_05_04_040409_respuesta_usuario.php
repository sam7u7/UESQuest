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
           $table->string('respuesta_texto')->nullable();
           $table->foreignId('id_realiza_encuesta')->references('id')->on('realiza_encuesta');
           $table->foreignId('id_pregunta')->references('id')->on('pregunta_base');
           $table->foreignId('id_respuesta')->nullable()->references('id')->on('tipo_respuesta');
           $table->timestamps();
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
