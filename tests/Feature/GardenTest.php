<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Garden;

class GardenTest extends TestCase
{

    public function test_index()
    {
        $response = $this->get('/gardens');

        $response->assertStatus(200);
    }

    public function test_store(){
        $this->post('/gardens',['name'=>'HuertoPrueba','image'=>'image'])
        ->assertStatus(201);
     }
     public function test_store_noName(){
         $this->post('/gardens',['image'=>'image'])->assertStatus(422);
     }

     public function test_store_noImage(){
         $this->post('/gardens',['name'=>'HuertoPrueba'])->assertStatus(422);
     }

    public function test_update_name(){
        Garden::factory()->create();
        $id = Garden::all()->last()->id;
        $this->put('/gardens/'.$id,['name'=> 'Tomato'])->assertStatus(200);
    }

    public function test_update_image(){
        Garden::factory(1)->create();
        $id = Garden::all()->last()->id;
        $this->put('/gardens/'.$id,['image'=> 'Tomato'])->assertStatus(200);
    }

    public function test_update_noNewFields(){
        $id = Garden::all()->last()->id;
        $this->put('/gardens/'.$id)->assertStatus(422);
    }


}
