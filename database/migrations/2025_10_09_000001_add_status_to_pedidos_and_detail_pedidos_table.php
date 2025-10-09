<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('pedidos', 'status')) {
                $table->boolean('status')->default(true)->after('deliveryStatus');
            }
            if (!Schema::hasColumn('pedidos', 'last_data_update')) {
                $table->timestamp('last_data_update')->nullable()->after('updated_at');
            }
        });

        Schema::table('detail_pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('detail_pedidos', 'status')) {
                $table->boolean('status')->default(true)->after('estado_produccion');
            }
        });

        DB::table('pedidos')->update(['status' => true]);
        DB::table('detail_pedidos')->update(['status' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('detail_pedidos', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
