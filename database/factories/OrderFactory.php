<?php

namespace Database\Factories;

use App\models\Order;
use App\models\Cart;
use App\models\Customer;
use App\models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
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
            'cart_id'     => Cart::factory(),
            'customer_id' => Customer::factory(),
            'payment_id'  => Payment::factory(),
            'order_date'  => $this->faker->dateTimeBetween('-1 month', 'now'),
            'status'      => $this->faker->randomElement([
                'pending',
                'paid',
                'shipped',
                'delivered',
        ]),
        ];
    }
}
