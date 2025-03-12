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
        Schema::create('detail_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedidos_id')->constrained()->onDelete('cascade');
            $table->string('articulo');
            $table->integer('cantidad');
            $table->decimal('unit_prize', total: 8, places: 2);
            $table->decimal('sub_total', total: 8, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pedidos');
    }
};
