<?php

namespace Database\Factories;

use App\models\OrderItem;
use App\models\Order;
use App\models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\orderItem>
 */
class orderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'          => Order::factory(),
            'cart_item_id'      => CartItem::factory(),
            'quantity'          => $this->faker->numberBetween(1, 5),
            'price_at_purchase' => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
