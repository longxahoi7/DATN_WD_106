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
            CategorySeeder::class, 
            BrandSeeder::class, 
            ProductSeeder::class,
            UserSeeder::class, 
            OrderSeeder::class, 
            OrderItemSeeder::class,
            AttributeSeeder::class, 
            AttributeProductSeeder::class,
            ProductImageSeeder::class,
            
            ShoppingCartSeeder::class, 
            CartItemSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
