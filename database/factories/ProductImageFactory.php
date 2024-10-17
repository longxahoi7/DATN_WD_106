<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AttributeProduct;
use App\Models\ProductImage;
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
            'attribute_product_id' => AttributeProduct::all()->random()->id,
            'image' => $this->faker->imageUrl(640, 480),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
