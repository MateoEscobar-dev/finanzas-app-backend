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
        Schema::create('logs_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_log')->references('id')->on('logs')->comment("Logs ID");
            $table->integer('id_register')->default(0);
            $table->string('field', 255)->nullable(true);
            $table->longText('value')->nullable(true);
            $table->longText('new')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_information');
    }
};
