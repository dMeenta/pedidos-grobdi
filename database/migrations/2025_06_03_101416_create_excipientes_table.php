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
        Schema::create('excipientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredientes_id')->constrained('ingredientes')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('cantidad',8,2);
            $table->string('unidad_medida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excipientes');
    }
};
