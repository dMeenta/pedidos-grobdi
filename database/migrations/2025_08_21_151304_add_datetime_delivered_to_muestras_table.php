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
            $table->dateTime('datetime_delivered')->nullable()->after('fecha_hora_entrega');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropColumn('datetime_delivered');
        });
    }
};
