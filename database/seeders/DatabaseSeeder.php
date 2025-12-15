<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Jalankan CategorySeeder dulu
        $this->call(CategorySeeder::class);
        
        // Ambil semua category yang baru dibuat
        $categories = Category::all();

        // 2. Buat 5 User
        User::factory(5)->create()->each(function ($user) use ($categories) {
            
            // Setiap User otomatis dibuatkan 1 Store
            $store = Store::factory()->create([
                'user_id' => $user->id,
            ]);

            // Setiap Store dibuatkan 10 Produk
            Product::factory(10)->create([
                'store_id' => $store->id,
                // Pilih kategori acak untuk setiap produk
                'category_id' => $categories->random()->id,
            ]);
        });
        
        // 3. Buat 1 Akun Khusus untuk Kamu Login nanti
        User::factory()->create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@rigcycle.com',
            'password' => bcrypt('password'), // Passwordnya: password
        ]);
    }
}