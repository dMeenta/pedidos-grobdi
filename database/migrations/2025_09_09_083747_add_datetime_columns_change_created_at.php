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
            $table->timestamp('datetime_foto_domicilio')->nullable()->after('foto_domicilio');
            $table->timestamp('datetime_foto_entrega')->nullable()->after('foto_entrega');
            $table->dropTimestamps();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos_delivery_state', function (Blueprint $table) {
            $table->dropColumn(['datetime_foto_domicilio', 'datetime_foto_entrega']);
            $table->dropColumn('created_at');
            $table->timestamps();
        });
    }
};
