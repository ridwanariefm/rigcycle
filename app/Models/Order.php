<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // --- PERBAIKAN DI BAGIAN FILLABLE ---
    // Tambahkan semua field yang dibutuhkan untuk Checkout dan Detail Order
    protected $fillable = [
        'user_id', 
        'order_number', 
        'total_price', 
        'subtotal', // <--- PENTING: Untuk rincian harga (Subtotal sebelum ongkir)
        'shipping_cost', // <--- PENTING: Biaya kirim
        'status', 
        
        // --- DETAIL CUSTOMER & ALAMAT PENGIRIMAN ---
        'user_name',     // <--- NAMA penerima
        'user_phone',    // <--- NOMOR HP penerima
        'shipping_address', // <--- ALAMAT LENGKAP
        'province',      // <--- Provinsi
        'city',          // <--- Kota/Kabupaten
        'zip_code',      // <--- Kode Pos
        
        // --- DETAIL KURIR & PEMBAYARAN ---
        'courier',       // <--- Nama Kurir
        'payment_method',// <--- Metode Pembayaran
    ];

    public function items()
    {
        // Relasi ke OrderItem
        return $this->hasMany(OrderItem::class); 
    }
    
    public function user()
    {
        // Relasi ke User
        return $this->belongsTo(User::class);
    }
}