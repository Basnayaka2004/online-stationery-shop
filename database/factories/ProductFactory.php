<?php

namespace Database\Factories;

use App\models\Product;
use App\models\Category;
use App\models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
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
            'product_name'    => $this->faker->words(3, true),
            'description'     => $this->faker->sentence(12),
            'price'            => $this->faker->randomFloat(2, 100, 5000),
            'stock_quantity'   => $this->faker->numberBetween(1, 100),
            'category_id'      => Category::factory(),
            'admin_id'         => Admin::factory(),
        ];
    }
}
