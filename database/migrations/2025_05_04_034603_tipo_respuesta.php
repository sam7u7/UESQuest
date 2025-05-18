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
        schema::create("tipo_respuesta", function (Blueprint $table) {
           $table->id();
           $table->foreignId("id_tipo_pregunta")->references("id")->on("tipo_pregunta");
           $table->string("respuesta");
           $table->boolean("correcta");
           $table->integer("orden");
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
        Schema::dropIfExists('tipo_respuesta');
    }
};
