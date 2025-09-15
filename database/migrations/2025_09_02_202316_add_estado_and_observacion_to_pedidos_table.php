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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('estado_laboratorio')->default('pendiente')->after('productionStatus'); // pendiente, aprobado, reprogramado
            $table->text('observacion_laboratorio')->nullable()->after('estado_laboratorio');
            $table->date('fecha_reprogramacion')->nullable()->after('observacion_laboratorio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['estado_laboratorio', 'observacion_laboratorio', 'fecha_reprogramacion']);
        });
    }
};
