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
        Schema::table('muestras', function (Blueprint $table) {
            $table->renameColumn('tipo_muestra', 'tipo_frasco');
            $table->unsignedBigInteger('id_tipo_muestra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropColumn('id_tipo_muestra');
            $table->renameColumn('tipo_frasco', 'tipo_muestra');
        });
    }
};
