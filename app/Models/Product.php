<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Mass Assignment Protection (Agar aman saat input data)
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'image',
        'price',
        'weight',
        'condition',
        'specs',
        'is_active',
        'description',
        'stock',
    ];

    // CASTING (Sangat Penting!)
    // Ini mengubah data JSON di database langsung jadi Array PHP saat kita ambil.
    // Jadi di controller nanti tinggal panggil $product->specs['brand']
    protected function casts(): array
    {
        return [
            'specs' => 'array',
            'is_active' => 'boolean',
        ];
    }

    // RELASI
    // "Produk ini milik satu Toko"
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    // "Produk ini masuk satu Kategori"
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}