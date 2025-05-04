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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rol')->references('id')->on('rol')->onDelete('cascade');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('telefono');
            $table->string('correo');
            $table->string('password');
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
        Schema::dropIfExists('usuario');
    }
};
