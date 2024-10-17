<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'order_id' => Order::all()->random()->order_id,
            'product_id' => Product::all()->random()->product_id,
            'quantity' => $this->faker->randomNumber(1, 50),
            'price' => $this->faker->randomFloat(1, 50, 2),
            // 'total' => $this->faker->randomFloat(1, 50, 2),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
