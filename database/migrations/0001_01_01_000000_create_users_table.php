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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('document')->unique()->comment('Numero de identificacion');
            $table->string('first_name')->comment('Primer nombre');
            $table->string('second_name')->nullable()->comment('Segundo nombre');
            $table->string('first_last_name')->comment('Primer apellido');
            $table->string('second_last_name')->nullable()->comment('Segundo apellido');
            $table->string('address', 255)->nullable(true);
            $table->string('email', 255)->nullable(true);
            $table->string('phone')->nullable()->comment('Telefono');
            $table->string('phone_ext')->nullable()->comment('Extension del telefono');
            $table->date('birth_day')->nullable(true);
            $table->string('password', 255)->nullable(true);
            $table->string('lang', 80)->default("es")->nullable(false);
            $table->tinyInteger('active')->default('1');
            $table->string('imagen', 255)->nullable(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('last_notification')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
