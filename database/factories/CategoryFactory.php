<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => "Category " . $this->faker->randomNumber('2'),
            'first_closure_date' => Carbon::now()->addDays(2),
            'second_closure_date' => Carbon::now()->addDays(16),
        ];
    }
}
