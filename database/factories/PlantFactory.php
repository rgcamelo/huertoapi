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
        return [
            'status' => 'HOla',
            'bed_id' => Bed::all()->random()->id,
            'seed_id' => Seed::all()->random()->id,
        ];
    }
}
