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
        Schema::create('tipo_cambio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_moneda_id')->constrained('tipo_moneda')->onDelete('cascade');
            $table->decimal('valor_compra', 10, 4);
            $table->decimal('valor_venta', 10, 4);
            $table->date('fecha'); //fecha que se hace el cambio
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_cambio');
    }
};
