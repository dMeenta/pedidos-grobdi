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
        Schema::table('centrosalud', function (Blueprint $table) {

            // Cambiar la precisión de los campos latitude y longitude
            $table->decimal('latitude', 12, 7)->nullable()->change();
            $table->decimal('longitude', 12, 7)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centrosalud', function (Blueprint $table) {
            // Restaurar la precisión anterior
            $table->decimal('latitude', 8, 6)->nullable()->change();
            $table->decimal('longitude', 9, 6)->nullable()->change();
        });
    }
};
