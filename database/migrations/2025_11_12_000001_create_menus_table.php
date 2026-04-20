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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // item-1, item-110, etc
            $table->string('label'); // Configuración General, etc
            $table->string('icon')->nullable(); // uil-cog, mdi mdi-window-maximize, etc
            $table->string('link')->nullable(); // /TfrmParametros, /TfrmEmpresa, etc
            $table->string('parent_key')->nullable(); // item-1, item-30000, etc
            $table->boolean('is_title')->default(false);
            $table->boolean('collapsed')->default(true);
            $table->integer('id_sistema_pantalla')->nullable(); // 1, 110, 118, etc
            $table->integer('order')->default(0); // -1, 1, 2, 3, etc
            $table->unsignedBigInteger('padre_id')->default(0); // 0, 1, 30000, etc
            $table->integer('icon_id')->nullable(); // 46, 33, 52, etc
            $table->boolean('flag_detalle')->default(false);
            $table->boolean('flag_visible')->default(true);
            $table->integer('id_sistema')->nullable(); // 1, 7, 3, 6, 30, etc
            $table->unsignedBigInteger('parent_menu_id')->nullable(); // Referencia a ID del menú padre
            $table->timestamp('bt_fecha')->nullable();
            $table->string('bt_login')->nullable();
            $table->timestamps();

            $table->foreign('parent_menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
