<?php

namespace Database\Factories;

use App\models\Payment;
use App\models\Customer;
use App\models\Cart;
use App\models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'     => Customer::factory(),
            'cart_id'         => Cart::factory(),
            'order_id'        => Order::factory(),
            'payment_method'  => $this->faker->randomElement(['Credit Card', 'Debit Card', 'PayPal', 'Cash']),
            'payment_amount'  => $this->faker->randomFloat(2, 100, 5000),
            'payment_date'    => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
