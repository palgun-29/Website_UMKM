<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('image')->nullable();
        $table->string('alt')->nullable();
        $table->integer('price');
        $table->integer('stock');
        $table->text('description')->nullable();
        $table->timestamps();
    });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};