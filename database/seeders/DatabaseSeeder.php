<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // CategorySeeder::class, 1
            // BrandSeeder::class, 2
            // ProductSeeder::class,5
            // UserSeeder::class, 3
            // OrderSeeder::class, 4
            // OrderItemSeeder::class, 7
            // AttributeProductSeeder::class,
            ProductImageSeeder::class,
            // ShoppingCartSeeder::class, 6
            // CartItemSeeder::class, 9
            // PaymentSeeder::class, 8
        ]);
    }
}
