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
        Schema::create('error_exception', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_log')->references('id')->on('logs')->comment("Logs ID");
            $table->string('type', 90)->comment("Tipo de excepción");
            $table->text('message')->comment("Mensaje");
            $table->text('params')->comment("Parametros");
            $table->string('endpoint', 255)->comment("Punto final");
            $table->text('result')->comment("Resultado");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_exception');
    }
};
