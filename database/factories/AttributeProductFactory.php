<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttributeProductFactory extends Factory
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
            'attribute_id' => Attribute::all()->random()->attribute_id,
            'product_id' => Product::all()->random()->product_id,
            'image' => $this->faker->imageUrl(640, 480),
            'price' => $this->faker->randomFloat(1, 50, 2),
            'in_stock' => $this->faker->randomNumber(1, 500),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
