<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
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
            'user_id' => User::all()->random()->user_id,
            'order_date' => $this->faker->dateTime,
            'invoice_date' => $this->faker->dateTime,
            'total' => $this->faker->randomFloat(1, 50, 2),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'status' => $this->faker-> randomElement(['pending', 'processing', 'shipped','delivered', 'cancelled', 'completed',]),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
