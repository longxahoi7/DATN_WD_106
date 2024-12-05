<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Color;
use App\Models\Size;

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
            // 'attribute_id' => AttributeProduct::all()->random()->attribute_id,
            'product_id' => Product::all()->random()->product_id,
            // 'image' => $this->faker->imageUrl(640, 480),
            'color_id' => Color::factory(),     // Tạo màu sắc giả liên kết
            'size_id' => Size::factory(),       // Tạo kích thước giả liên kết
            'in_stock' => $this->faker->numberBetween(0, 100), // Số lượng tồn kho ngẫu nhiên
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
