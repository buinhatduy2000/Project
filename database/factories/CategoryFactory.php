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
            '1st_closure_date' => Carbon::now(),
            '2nd_closure_date' => Carbon::now()->addDays(14),
        ];
    }
}
