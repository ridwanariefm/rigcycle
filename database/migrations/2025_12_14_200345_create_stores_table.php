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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            
            // Relasi: Toko ini milik User siapa?
            // cascadeOnDelete: Jika User dihapus, Tokonya ikut terhapus.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->string('name');
            $table->string('slug')->unique(); // URL toko
            $table->text('description')->nullable();
            
            // Kita simpan ID kota saja (integer) untuk integrasi RajaOngkir nanti
            $table->unsignedBigInteger('city_id')->default(1); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};