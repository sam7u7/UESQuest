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
        Schema::create('pregunta_base', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encuesta_id')->references('id')->on('encuesta')->onDelete('cascade');
            $table->string('pregunta');
            $table->double('ponderacion');
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
        Schema::dropIfExists('pregunta_base');
    }
};
