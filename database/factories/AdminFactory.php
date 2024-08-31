<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'name'           => $this->faker->name ,
        'email'          => $this->faker->unique()->safeEmail ,
        'password'       => Hash::make(123456) ,
        'remember_token' => Str::random(16) ,
        ];
    }
}
