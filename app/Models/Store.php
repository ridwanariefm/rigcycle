<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- WAJIB ADA
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory; // <--- WAJIB ADA

    // Agar kolom ini bisa diisi otomatis oleh Seeder/Factory
    protected $fillable = [
        'user_id',
        'city_id',
        'name',
        'slug',
        'description',
    ];

    // Relasi: Toko milik User siapa?
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Toko punya banyak Produk
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}