<?php

namespace Database\Factories;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'name' => $faker->userName(),
            'email' => $faker->freeEmail(),
            'password'=> $faker->password(6, 12),
            'phone' => $faker->phoneNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
