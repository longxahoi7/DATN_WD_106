<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
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
            'brand_id' => Brand::all()->random()->brand_id,
            'product_category_id' => Category::all()->random()->category_id,
            'main_image_url' => $this->faker->imageUrl(640, 480, 'products', true), // URL hình ảnh giả
            'view_count' => $this->faker->numberBetween(0, 1000), // Số lượt xem giả
            'discount' => $this->faker->randomFloat(2, 0, 50), // Giảm giá từ 0-50%
            'start_date' => $this->faker->optional()->date(), // Ngày bắt đầu (tuỳ chọn)
            'end_date' => $this->faker->optional()->date(), // Ngày kết thúc (tuỳ chọn)
            'description' => $this->faker->text,
            'subtitle' => $this->faker->text,
            'sku' => $this->faker->text,
            'slug' => $this->faker->text,
            'is_active' => $this->faker->randomNumber(1, 500),
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
