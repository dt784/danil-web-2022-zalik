<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    protected $model = Employer::class;

    public function definition()
    {
        return [
            "name" => fake()->name,
            "address" => fake()->address,
            "card_code" => fake()->creditCardNumber,
        ];
    }
}
