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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('lastname',50);
            $table->string('type_document',50)->nullable();
            $table->string('number_document',50)->nullable();
            $table->string('CMP',50)->nullable();
            $table->string('phone',12)->nullable();
            $table->date('birthdate')->nullable()->default(null);
            $table->foreignId('distrito_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('especialidad_id')->constrained('especialidad')->cascadeOnDelete();
            $table->foreignId('centrosalud_id')->constrained('centrosalud')->cascadeOnDelete();
            $table->string('categoria_medico');
            $table->string('tipo_medico');
            $table->boolean('asignado_consultorio');
            $table->boolean('songs')->default(0);
            $table->string('observations')->nullable();
            $table->string('name_secretariat')->nullable();
            $table->string('phone_secretariat',12)->nullable();
            $table->boolean('state')->default(1);
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
