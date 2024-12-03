<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttributeProduct;
use App\Models\ProductImage;
use App\Models\Color;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            //
            'attribute_product_id' => AttributeProduct::inRandomOrder()->first()->attribute_product_id, // Lấy ngẫu nhiên một attribute_product_id
            'color_id' => Color::inRandomOrder()->first()->color_id, // Lấy ngẫu nhiên một color_id
            'url' => $this->faker->imageUrl(640, 480, 'products'),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
