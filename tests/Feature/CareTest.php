<?php

namespace Tests\Feature;

use App\Models\Care;
use App\Models\Plant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/cares');

        $response->assertStatus(200);
    }

    public function test_store(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();

        $this->post('/plants/'.$plant->id.'/cares',[
            'type' => Care::TYPE_WATER,
            'description' => 'Riego'
        ])->assertStatus(200);
    }

    public function test_store_noType(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();

        $this->post('/plants/'.$plant->id.'/cares',[
            'description' => 'Riego'
        ])->assertStatus(422);
    }

    public function test_store_noDescription(){
        Plant::factory(1)->create();
        $plant = Plant::all()->last();

        $this->post('/plants/'.$plant->id.'/cares',[
            'type' => Care::TYPE_WATER,
        ])->assertStatus(422);
    }

    public function test_update_type(){
        Care::factory(1)->create();
        $care = Care::all()->last();

        $this->put('/plants/'.$care->plant_id.'/cares/'.$care->id,[
            'type' => Care::TYPE_CROP,
        ])->assertStatus(200);
    }

    public function test_update_description(){
        Care::factory(1)->create();
        $care = Care::all()->last();

        $this->put('/plants/'.$care->plant_id.'/cares/'.$care->id,[
            'description' => 'Una nueva descripcion',
        ])->assertStatus(200);
    }

    public function test_update_Error(){
        Care::factory(1)->create();
        $care = Care::all()->last();

        $this->put('/plants/'.$care->plant_id.'/cares/'.$care->id)->assertStatus(422);
    }

    public function test_delete(){
        Care::factory(1)->create();
        $care = Care::all()->last();

        $this->delete('/plants/'.$care->plant_id.'/cares/'.$care->id)->assertStatus(200);
    }




}
