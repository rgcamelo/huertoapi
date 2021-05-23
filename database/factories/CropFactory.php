<?php

namespace Database\Factories;

use App\Models\Crop;
use App\Models\Care;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CropFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Crop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(0,15),
            'plant_id' => Plant::all()->random()->id,
            'care' => Care::all()->random()->id,
        ];
    }
}
