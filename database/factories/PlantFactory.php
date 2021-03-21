<?php

namespace Database\Factories;

use App\Models\Bed;
use App\Models\Plant;
use App\Models\Seed;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bed = Bed::all()->random();
        $seed = Seed::all()->random();
        return [
            'name' => $seed->name,
            'bed_id' => $bed->id,
            'seed_id' => $seed->id,
            'quantity' => $this->faker->numberBetween(0,15),
        ];
    }
}
