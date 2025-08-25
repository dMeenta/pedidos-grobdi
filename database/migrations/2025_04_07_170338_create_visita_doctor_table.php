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
        Schema::create('visita_doctor', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->boolean('turno')->default(0);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('doctor')->cascadeOnDelete();
            $table->foreignId('enrutamientolista_id')->constrained('enrutamiento_lista')->cascadeOnDelete();
            $table->foreignId('estado_visita_id')->constrained('estado_visita')->cascadeOnDelete();
            $table->decimal('latitude', 10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->string('observaciones_visita')->nullable();
            $table->timestamps();
            $table->boolean('reprogramar')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visita_doctor');
    }
};
