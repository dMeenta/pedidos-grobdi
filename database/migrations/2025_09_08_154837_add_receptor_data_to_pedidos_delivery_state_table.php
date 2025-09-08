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
        Schema::table('pedidos_delivery_state', function (Blueprint $table) {
            $table->string('receptor_nombre')->nullable()->after('datetime_foto_entrega');
            $table->longText('receptor_firma')->nullable()->after('receptor_nombre');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos_delivery_state', function (Blueprint $table) {
            $table->dropColumn(['receptor_nombre', 'receptor_firma']);
        });
    }
};
