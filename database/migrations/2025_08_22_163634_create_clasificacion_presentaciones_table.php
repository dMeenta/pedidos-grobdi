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
        Schema::create('clasificacion_presentaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('clasificacion_id')->constrained('clasificaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificacion_presentaciones');
    }
};
