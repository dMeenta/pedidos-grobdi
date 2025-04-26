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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->unique();
            $table->integer('nroOrder')->nullable();
            $table->string('customerName');
            $table->string('customerNumber')->nullable();
            $table->string('doctorName');
            $table->text('address');
            $table->text('reference');
            $table->string('district');
            $table->decimal('prize', total: 8, places: 2);
            $table->string('paymentStatus');
            $table->boolean('productionStatus')->default(0);
            $table->boolean('accountingStatus')->default(0);
            $table->boolean('turno')->default(0);
            $table->date('deliveryDate');
            $table->string('deliveryStatus');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('zone_id')->constrained(); 
            $table->string('voucher')->nullable();
            $table->string('receta')->nullable();
            $table->string('fotoDomicilio')->nullable();
            $table->string('fotoEntrega')->nullable();
            $table->string('operationNumber')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('detailMotorizado')->nullable();
            $table->string('bancoDestino')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
