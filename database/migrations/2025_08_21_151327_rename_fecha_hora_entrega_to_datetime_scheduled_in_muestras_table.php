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
            $table->renameColumn('fecha_hora_entrega', 'datetime_scheduled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->renameColumn('datetime_scheduled', 'fecha_hora_entrega');
        });
    }
};
