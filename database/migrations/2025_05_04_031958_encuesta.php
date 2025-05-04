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
        Schema::create('encuesta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
            $table->foreignId('id_grupo')->references('id')->on('grupo_meta')->onDelete('cascade');
            $table->string('titulo');
            $table->string('objetivo');
            $table->string('indicacion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('encuesta');
    }
};
