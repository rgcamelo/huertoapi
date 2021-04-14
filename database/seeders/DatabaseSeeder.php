<?php

namespace Database\Seeders;

use App\Models\Bed;
use App\Models\Care;
use App\Models\Crop;
use App\Models\Garden;
use App\Models\Ground;
use App\Models\Plant;
use App\Models\Seed;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::factory(10)->create();
        Garden::factory(2)->create();
        Ground::factory(10)->create();
        Bed::factory(150)->create();
        Seed::factory(50)->create();
        Plant::factory(150)->create();
        Care::factory(200)->create();
        Crop::factory(50)->create();
    }
}
