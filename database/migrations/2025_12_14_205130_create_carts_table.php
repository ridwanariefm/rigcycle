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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            // Keranjang milik siapa?
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Barang apa yang dimasukkan?
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            // Berapa banyak?
            $table->integer('quantity')->default(1);
            $table->timestamps();

            // OPTIMASI: 
            // Satu user tidak boleh punya 2 baris terpisah untuk produk yang sama.
            // Kalau beli lagi, harusnya quantity-nya yang nambah, bukan baris baru.
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};