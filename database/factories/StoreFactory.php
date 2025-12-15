<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Membuat nama perusahaan acak, contoh: "Cyber Tech", "Global Komputer"
            'name' => fake()->company(), 
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            // Kita skip city_id dulu atau set default 1 (Jakarta)
            'city_id' => 1, 
        ];
    }
}