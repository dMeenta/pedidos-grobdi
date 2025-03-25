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
        Schema::create('centrosalud', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('description',255)->nullable();
            $table->string('adress',150)->nullable();
            $table->decimal('latitude',8,6)->nullable();
            $table->decimal('longitude',9,6)->nullable();
            $table->boolean('state')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centrosalud');
    }
};
