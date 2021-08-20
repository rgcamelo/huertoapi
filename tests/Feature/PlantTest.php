<?php

namespace Tests\Feature;

use App\Models\Bed;
use App\Models\Plant;
use App\Models\Seed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlantTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/plants');

        $response->assertStatus(200);
    }

    public function test_store(){
        Bed::factory(1)->create();
        Seed::factory(1)->create();

        $bed = Bed::all()->last();
        $seed = Seed::all()->last();

        $this->post('/beds/'.$bed->id.'/seed/'.$seed->id.'/plants',['quantity'=>50])->assertStatus(201);
    }

    public function test_store_error(){
        Bed::factory(1)->create();
        Seed::factory(1)->create();

        $bed = Bed::all()->last();
        $seed = Seed::all()->last();

        $this->post('/beds/'.$bed->id.'/seed/'.$seed->id.'/plants')->assertStatus(422);
    }

    public function test_updateError(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();

        $this->put('/beds/'.$plant->bed_id.'/seed/'.$plant->seed_id.'/plants/'.$plant->id)->assertStatus(422);
    }

    public function test_updateQuantity(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();

        $this->put('/beds/'.$plant->bed_id.'/seed/'.$plant->seed_id.'/plants/'.$plant->id,['quantity'=>40])->assertStatus(200);
    }

    public function test_delete(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();
        $this->delete('/beds/'.$plant->bed_id.'/seed/'.$plant->seed_id.'/plants/'.$plant->id)->assertStatus(200);
    }
}
