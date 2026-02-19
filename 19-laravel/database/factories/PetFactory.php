<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name'=> fake()->colorName(),
        'kind'=> fake()->radomElement(['Dog', 'Cat', 'Pig', 'Bird']),
        'weight'=> fake()->numerify('#.#'),
        'age'=> fake()->numberBetween(1, 15),
        'breed'=> fake()->radomElemente(['type1','type2','type3','type4',]),
        'location'=> fake()->city(),
        'description'=> fake()->sentence(5)
        ];
    }
}
