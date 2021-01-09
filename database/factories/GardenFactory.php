<?php

namespace Database\Factories;

use App\Models\Garden;
use Illuminate\Database\Eloquent\Factories\Factory;

class GardenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Garden::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'status' => $this->faker->randomElement([Garden::GARDEN_DISPONIBLE,Garden::GARDEN_NO_DISPONIBLE])
        ];
    }
}
