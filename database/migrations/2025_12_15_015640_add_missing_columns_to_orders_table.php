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
        // Field Harga & Biaya
        $table->decimal('subtotal', 15, 2)->after('total_price')->nullable();
        $table->decimal('shipping_cost', 15, 2)->after('subtotal')->nullable();

        // Field Detail Pengguna & Alamat (diambil dari checkout form)
        $table->string('user_name')->after('user_id')->nullable();
        $table->string('user_phone')->after('user_name')->nullable();
        
        // Kolom Alamat Lengkap yang Hilang (Ini yang menyebabkan error 42S22)
        $table->string('shipping_address', 500)->after('user_phone')->nullable();
        
        // Kolom Alamat yang lebih terstruktur
        $table->string('province')->after('shipping_address')->nullable();
        $table->string('city')->after('province')->nullable();
        $table->string('zip_code', 10)->after('city')->nullable();
        $table->string('courier')->after('zip_code')->nullable();
        
        // Field Pembayaran
        $table->string('payment_method')->after('courier')->nullable();
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn([
            'subtotal',
            'shipping_cost',
            'user_name',
            'user_phone',
            'shipping_address', // <--- HARUS DITAMBAHKAN
            'province',
            'city',
            'zip_code',
            'courier',
            'payment_method'
        ]);
    });
}
};