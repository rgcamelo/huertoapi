<?php

namespace Database\Factories;

use App\Models\Seed;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement([Seed::SEED_DISPONIBLE]),
            'image' => $this->faker->randomElement(['1.png','2.jpg']),
        ];
    }
}
