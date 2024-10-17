<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
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
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl(640, 480),
            'slug' => $this->faker->text,
            'is_active' => $this->faker->randomNumber(1, 500),
            'parent_id' => $this->faker->randomNumber(1, 50),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
