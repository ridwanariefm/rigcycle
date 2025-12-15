<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // --- INI BAGIAN PALING PENTING ---
    // Tanpa 'quantity' disini, angka tidak akan pernah berubah di database
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity', 
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}