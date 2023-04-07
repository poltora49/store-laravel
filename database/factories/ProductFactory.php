<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2,true)),
            'description'=> $this->faker->text(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'thumbnail' => $this->faker->image('public/storage/product', 640, 540, null, false),
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'hidden'=> $this->faker->boolean(),
        ];
    }
}
