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
        Schema::create('pedidos_delivery_state', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->enum('state', ['asignado', 'entregado', 'reprogramado']);
            $table->foreignId('motorizado_id')->nullable()->constrained('users');
            $table->text('observacion')->nullable();
            $table->string('foto_domicilio')->nullable();
            $table->string('foto_entrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_delivery_state');
    }
};
