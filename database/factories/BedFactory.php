<?php

namespace Database\Factories;

use App\Models\Bed;
use App\Models\Ground;
use Illuminate\Database\Eloquent\Factories\Factory;

class BedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ground = Ground::all()->random();

        return [
            'name' => $this->faker->name,
            'number' => $this->faker->numberBetween(0,15),
            'x' => $this->faker->numberBetween(0,15),
            'y' => $this->faker->numberBetween(0,15),
            'status' => $this->faker->randomElement([Bed::BED_DISPONIBLE]),
            'type' => $ground->type == 'module' ? $this->faker->randomElement([Bed::TYPE_FURROW,Bed::TYPE_TERRACE]) : Bed::TYPE_BED,
            'ground_id' => $ground->id,
        ];
    }
}
