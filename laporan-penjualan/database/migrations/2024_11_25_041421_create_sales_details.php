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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_products')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('id_sales')->references('id')->on('sales')->onDelete('cascade');
            $table->integer('jumlah_total');
            $table->integer('harga_satuan');
            $table->integer('subtotal');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
