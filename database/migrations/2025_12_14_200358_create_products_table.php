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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // RELASI (Foreign Keys)
            // constrained() otomatis mencari tabel 'stores' dan 'categories'
            // cascadeOnDelete() artinya: kalau Toko dihapus, produknya ikut terhapus otomatis.
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            // DATA UTAMA
            $table->string('name');
            $table->string('slug')->unique(); // Unique biar URL tidak tabrakan
            $table->string('image')->nullable(); // <--- TAMBAHKAN INI (Boleh kosong/nullable)
            
            // Mengapa BigInteger untuk harga? 
            // Best practice: Hindari Float/Double untuk uang karena masalah presisi.
            // Simpan sebagai angka bulat (Rupiah tidak butuh sen).
            $table->unsignedBigInteger('price'); 
            
            $table->integer('weight'); // Dalam gram (misal: 1200 gram)

            // ENUM untuk kondisi barang
            $table->enum('condition', ['new', 'used', 'refurbished'])->default('used');

            // JSON COLUMN (Fitur Keren)
            // Di sini kita simpan spek detail yang beda-beda tiap kategori.
            // Contoh isi: {"brand": "Asus", "memory": "8GB", "garansi": "Off"}
            $table->json('specs')->nullable();

            $table->boolean('is_active')->default(true); // Untuk menyembunyikan produk tanpa menghapus

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};