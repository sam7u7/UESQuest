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
        Schema::create('realiza_encuesta', function (Blueprint $table) {
           $table->id();
           $table->foreignId('id_usuario')->references('id')->on('usuario')->onDelete('cascade');
           $table->foreignId('id_encuesta')->references('id')->on('encuesta')->onDelete('cascade');
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
        Schema::dropIfExists('realiza_encuesta');
    }
};
