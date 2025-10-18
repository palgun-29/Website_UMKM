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
        Schema::table('flavors', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0); // Harga, misal: 15000.00
            $table->integer('stock')->default(0); // Stok barang
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flavors', function (Blueprint $table) {
            //
        });
    }
};
