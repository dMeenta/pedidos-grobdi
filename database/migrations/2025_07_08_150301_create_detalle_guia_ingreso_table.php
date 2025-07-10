<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detalle_guia_ingreso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guia_ingreso_id')->constrained('guia_ingreso')->onDelete('cascade');
            $table->foreignId('lote_id')->constrained('lotes')->onDelete('cascade');
            $table->date('fecha_vencimiento');
            $table->integer('cantidad');
            $table->foreignId('detalle_compra_id')->constrained('detalle_compra')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('detalle_guia_ingreso');
    }
};
