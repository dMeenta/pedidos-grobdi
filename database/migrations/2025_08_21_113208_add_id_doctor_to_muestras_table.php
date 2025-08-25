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
        Schema::table('muestras', function (Blueprint $table) {
            $table->unsignedBigInteger('id_doctor')->nullable()->after('name_doctor');
            $table->foreign('id_doctor')->references('id')->on('doctor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muestras', function (Blueprint $table) {
            $table->dropForeign(['id_doctor']);
            $table->dropColumn('id_doctor');
        });
    }
};
