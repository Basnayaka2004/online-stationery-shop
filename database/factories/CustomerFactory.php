<?php

namespace Database\Factories;

use App\models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'     => $this->faker->name(),
            'email'    => $this->faker->unique()->safeEmail(),
            'phone'    => $this->faker->phoneNumber(),
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'),
            'street'   => $this->faker->streetAddress(),
            'city'     => $this->faker->city(),
            'state'    => $this->faker->state(),
            'zip'      => $this->faker->postcode(),
        ];
    }
}
