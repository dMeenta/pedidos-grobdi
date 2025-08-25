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
            $table->foreignId('clasificacion_presentacion_id')
                ->nullable() // <-- esto es importante
                ->after('clasificacion_id')
                ->constrained('clasificacion_presentaciones')
                ->onDelete('set null'); // opcional: permite borrar presentaciones sin romper la muestra
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropForeign(['clasificacion_presentacion_id']);
            $table->dropColumn('clasificacion_presentacion_id');
        });
    }
};
