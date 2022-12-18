<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
    public function definition()
    {
        $name = $this->faker->realText(rand(10, 20));
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'shortdescription' => $this -> faker->realText(rand(50, 200)),
            'fulldescription' => $this -> faker->realText(rand(200, 500)),
            'price' => rand(1, 50),
            'weight' => rand(100, 2000),
            'subcategory_id' => rand(1, 4)
        ];
    }
}
