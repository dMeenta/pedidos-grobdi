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
            if (!Schema::hasColumn('muestras', 'id_tipo_muestra')) {
                $table->unsignedBigInteger('id_tipo_muestra')->nullable();
            }

            $table->foreign('id_tipo_muestra')->references('id')->on('tipo_muestras')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropForeign(['id_tipo_muestra']);
            $table->dropColumn('id_tipo_muestra');
        });
    }
};
