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
        Schema::create('enrutamiento_lista', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrutamiento_id')->constrained('enrutamiento')->cascadeOnDelete();
            $table->foreignId('lista_id')->constrained('lista')->cascadeOnDelete();
            $table->boolean('recovery')->default(0); // Assuming 'rec' is for recovery
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrutamiento_lista');
    }
};
