<?php

namespace Tests\Feature;

use App\Models\Care;
use App\Models\Crop;
use App\Models\Plant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CropTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/crops');

        $response->assertStatus(200);
    }

    public function test_store(){
        Plant::factory(1)->create();
        Care::factory(1)->create();

        $plant = Plant::all()->last();
        $care = Care::all()->last();
        $this->post('/plants/'.$plant->id.'/crop',[
            'quantity' => 50,
            'care' => $care->id
        ])->assertStatus(200);
    }

    public function test_store_noQuantity(){
        Plant::factory(1)->create();
        Care::factory(1)->create();

        $plant = Plant::all()->last();
        $care = Care::all()->last();

        $this->post('/plants/'.$plant->id.'/crop',[
            'care' => $care->id
        ])->assertStatus(422);
    }

    public function test_store_noCare(){
        Plant::factory(1)->create();
        Care::factory(1)->create();

        $plant = Plant::all()->last();
        $care = Care::all()->last();
        $this->post('/plants/'.$plant->id.'/crop',[
            'quantity' => 50,
        ])->assertStatus(422);
    }

    public function test_update_quantity(){
        Crop::factory(1)->create();
        $crop = crop::all()->last();

        $this->put('/plants/'.$crop->plant_id.'/crop/'.$crop->id,[
            'quantity' => 80,
        ])->assertStatus(200);
    }

    public function test_update_Error(){
        Crop::factory(1)->create();
        $crop = Crop::all()->last();

        $this->put('/plants/'.$crop->plant_id.'/crop/'.$crop->id)->assertStatus(422);
    }

    public function test_error(){
        Crop::factory(1)->create();
        $crop = Crop::all()->last();

        $this->delete('/plants/'.$crop->plant_id.'/crop/'.$crop->id)->assertStatus(200);
    }
}
