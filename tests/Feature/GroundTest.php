<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Garden;
use App\Models\Ground;

use function PHPSTORM_META\type;

class GroundTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/grounds');

        $response->assertStatus(200);
    }

    public function test_store(){
        $id = Garden::all()->random()->id;
        $this->post('/gardens/'.$id.'/grounds',[
            'name'=>'Zona',
            'type'=> Ground::TYPE_MODULE,
            'number_furrow' => 5,
            ])
        ->assertStatus(201);
    }

    public function test_store_noName(){
        $id = Garden::all()->random()->id;
        $this->post('/gardens/'.$id.'/grounds',[
            'type'=> Ground::TYPE_MODULE,
            'number_furrow' => 5,
            ])
        ->assertStatus(422);
    }

    public function test_store_noType(){
        $id = Garden::all()->random()->id;
        $this->post('/gardens/'.$id.'/grounds',[
            'name'=>'Zona',
            'number_furrow' => 5,
            ])
        ->assertStatus(422);
    }


    public function test_update_numberBeds(){
        $ground = Ground::all()->random();
        $this->put('/gardens/'.$ground->garden_id.'/grounds/'.$ground->id,
        ['number_furrow'=> rand(50, 150)])
        ->assertStatus(200);
    }

    public function test_update_typeGround(){
        $ground = Ground::all()->random();

        $type = '';
        if ($ground->type == Ground::TYPE_MODULE) {
            $type = Ground::TYPE_SEEDBED;
        }

        if ($ground->type == Ground::TYPE_SEEDBED) {
            $type = Ground::TYPE_MODULE;
        }

        $this->put('/gardens/'.$ground->garden_id.'/grounds/'.$ground->id,
        ['type'=> $type])
        ->assertStatus(200);
    }

    public function test_update_noChanges(){
        $ground = Ground::all()->random();
        $this->put('/gardens/'.$ground->garden_id.'/grounds/'.$ground->id)
        ->assertStatus(422);
    }


}
