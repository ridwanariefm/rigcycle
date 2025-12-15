<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3), // Nama produk: "Intel Core i5"
            'slug' => fake()->slug(),
            'price' => fake()->numberBetween(100000, 15000000), // Rp 100rb - 15 Juta
            'weight' => fake()->numberBetween(100, 5000), // Gram
            'condition' => fake()->randomElement(['new', 'used', 'refurbished']),
            'is_active' => true,

            // Generate JSON Specs palsu
            'specs' => [
                'brand' => fake()->word(),
                'warranty' => fake()->boolean() ? 'Official' : 'Distributor',
                'notes' => 'Unit only, no box',
            ],

            // KITA KOSONGKAN store_id & category_id DISINI
            // Karena nanti kita isi otomatis di DatabaseSeeder
        ];
    }
}