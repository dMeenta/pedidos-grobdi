<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Paso 1: Añadir nueva columna booleana
        Schema::table('muestras', function (Blueprint $table) {
            $table->boolean('lab_state')->default(false)->after('estado');
        });

        // Paso 2: Actualizar datos según valores existentes
        DB::table('muestras')->where('estado', 'Elaborado')->update(['lab_state' => true]);
        DB::table('muestras')->where('estado', 'Pendiente')->update(['lab_state' => false]);

        // Paso 3: Eliminar la columna vieja
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Paso 1: Volver a agregar la columna original
        Schema::table('muestras', function (Blueprint $table) {
            $table->string('estado', 50)->nullable();
        });

        // Paso 2: Restaurar valores originales
        DB::table('muestras')->where('lab_state', true)->update(['estado' => 'Elaborado']);
        DB::table('muestras')->where('lab_state', false)->update(['estado' => 'Pendiente']);

        // Paso 3: Eliminar la columna booleana
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropColumn('lab_state');
        });
    }
};
