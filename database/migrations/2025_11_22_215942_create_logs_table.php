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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('table', 255)->comment("tabla origen");
            $table->string('id_item', 255)->comment("ID Item de la tabla");
            $table->longText('operation')->comment("type de log");
            $table->longText('reason')->nullable(true)->comment("razon cambio");
            $table->foreignId('user')->references('id')->on('users');
            $table->dateTime('date', $precision = 0)->nullable(true)->comment("fecha registro");
            $table->tinyInteger('type')->default('0')->comment('Exception 1, Logs 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
