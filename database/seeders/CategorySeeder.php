<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Processors (CPU)',
            'Graphics Cards (GPU)',
            'Motherboards',
            'Memory (RAM)',
            'Storage (SSD/HDD)',
            'Power Supply (PSU)',
            'PC Cases',
            'Cooling & Fans',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                // Str::slug mengubah "Graphics Cards (GPU)" jadi "graphics-cards-gpu"
                'slug' => Str::slug($category), 
            ]);
        }
    }
}