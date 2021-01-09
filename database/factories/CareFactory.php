<?php

namespace Database\Factories;

use App\Models\Care;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CareFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Care::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph(1),
            'type' => $this->faker->randomElement([Care::TYPE_EYE,Care::TYPE_MANURE,Care::TYPE_PLAGUE,Care::TYPE_WATER]),
            'plant_id' => Plant::all()->random()->id,
        ];
    }
}
