<?php

namespace Database\Factories;

use App\models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin>
 */
class adminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_name' => $this->faker->name(),
            'email'      => $this->faker->unique()->safeEmail(),
            'username'   => $this->faker->unique()->userName(),
            'password'   => Hash::make('admin123'),
        ];
    }
}
