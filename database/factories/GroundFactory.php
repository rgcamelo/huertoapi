<?php

namespace Database\Factories;

use App\Models\Garden;
use App\Models\Ground;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ground::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'status' => $this->faker->randomElement([Ground::GROUND_DISPONIBLE]),
            'type' => $this->faker->randomElement([Ground::TYPE_MODULE]),
            'number_bed' => $this->faker->numberBetween(0,15),
            'number_furrow' => $this->faker->numberBetween(0,15),
            'number_terrace' => $this->faker->numberBetween(0,15),
            'garden_id' => Garden::all()->random()->id,
        ];
    }
}
