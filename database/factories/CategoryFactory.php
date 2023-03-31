<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2,true)),
            'thumbnail' => $this->faker->image('public/storage/category', 640, 540, null, false),
            'hidden'=> $this->faker->boolean(),
            'sorting'=> $this->faker->numberBetween(1,999)
        ];
    }
}
