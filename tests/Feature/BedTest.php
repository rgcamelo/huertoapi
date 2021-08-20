<?php

namespace Tests\Feature;

use App\Models\Bed;
use App\Models\Ground;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BedTest extends TestCase
{
    public function test_index()
    {

        $response = $this->get('/beds');

        $response->assertStatus(200);
    }

    public function test_store_noType(){
        Ground::factory(1)->create();
        $id = Ground::all()->last()->id;
        $this->post('/grounds/'.$id.'/beds',[
            'name' => 'NuevaCama',
            'number' => 1,
            'x' => 0.5,
            'y' => 6.2,
            'type' => Bed::TYPE_FURROW,
            ])
        ->assertStatus(422);
    }

    public function test_store_noNumber(){
        $id = Ground::all()->last()->id;
        $this->post('/grounds/'.$id.'/beds',[
            'name' => 'NuevaCama',
            'x' => 0.5,
            'y' => 6.2,
            ])
        ->assertStatus(422);
    }

    public function test_store_incorrectX(){
        $id = Ground::all()->last()->id;
        $this->post('/grounds/'.$id.'/beds',[
            'name' => 'NuevaCama',
            'number' => 5,
            'x' => '1',
            'y' => 6.2,
            ])
        ->assertStatus(422);
    }

    public function test_store_incorrectY(){
        $id = Ground::all()->last()->id;
        $this->post('/grounds/'.$id.'/beds',[
            'name' => 'NuevaCama',
            'number' => 5,
            'x' => 0.5,
            'y' => '1',
            ])
        ->assertStatus(422);
    }


    public function test_update_name(){
        Bed::factory(1)->create();
        $bed = Bed::all()->last();
        $this->put('/grounds/'.$bed->ground_id.'/beds/'.$bed->id,
        ['name'=> 'NuevoNombre'])
        ->assertStatus(200);
    }


    public function test_update_noChanges(){

        $bed = Bed::all()->last();
        $this->put('/grounds/'.$bed->ground_id.'/beds/'.$bed->id)
        ->assertStatus(422);
    }
}
