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
        Schema::table('orders', function (Blueprint $table) {
            
            // --- TAMBAHKAN HANYA KOLOM YANG HILANG (shipping_address) ---

            // Kolom Alamat Lengkap yang Hilang (Ini yang menyebabkan error 42S22)
            // Kita letakkan setelah user_phone (kolom terakhir yang ada di screenshot sebelum address)
            $table->string('shipping_address', 500)->after('user_phone')->nullable();
            
            // Semua kolom lain (subtotal, user_name, city, etc.) sudah ada di database,
            // jadi tidak perlu ditambahkan lagi di migrasi ini.

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_address', // Hanya kolom yang ditambahkan di up()
            ]);
        });
    }
};