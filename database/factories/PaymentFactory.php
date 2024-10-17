<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
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
            'amount' => $this->faker->randomFloat(1, 50, 2),
            'payment_method' => $this->faker->text,
            'status' => $this->faker->randomElement(['pending', 'failed', 'completed']),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
