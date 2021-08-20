<?php

namespace Tests\Feature;

use App\Http\Controllers\Seed\SeedController;
use App\Models\Seed;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\TestCase;

class SeedTest extends TestCase
{

    public function test_index(){
        $this->get(route('seeds.index'))->assertStatus(200);
    }

    public function test_store(){
       $this->post('/seeds',['name'=>'Tomate','image'=>'image'])->assertStatus(201);
    }
    public function test_store_noName(){
        $this->post('/seeds',['image'=>'image'])->assertStatus(422);
    }

    public function test_store_noImage(){
        $this->post('/seeds',['name'=>'Tomate'])->assertStatus(422);
    }

    public function test_update(){
        $id = Seed::all()->last()->id;
        $this->put('/seeds/'.$id,['name'=>'Tomatee'])->assertStatus(200);
    }

    public function test_update_noNewFields(){
        $id = Seed::all()->last()->id;
        $this->put('/seeds/'.$id)->assertStatus(422);
    }





}
