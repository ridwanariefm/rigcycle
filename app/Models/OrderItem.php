<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    /**
     * Relasi ke Product
     * (Satu baris item adalah milik satu produk)
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke Order (Opsional, tapi bagus untuk ada)
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}