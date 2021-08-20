<?php

namespace Tests\Feature;

use App\Models\Bed;
use App\Models\Garden;
use App\Models\Ground;
use App\Models\Seed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class zDeletesTest extends TestCase
{
    public function test_delete_bed(){
        $bed = Bed::all()->last();
        $this->delete('/grounds/'.$bed->ground_id.'/beds/'.$bed->id)
        ->assertStatus(200);
    }

    public function test_delete_ground(){
        $ground = Ground::all()->last();
        $this->delete('/gardens/'.$ground->garden_id.'/grounds/'.$ground->id)
        ->assertStatus(200);
    }

    public function test_delete_garden(){
        $id = Garden::all()->last()->id;
        $this->delete('/gardens/'.$id)->assertStatus(200);
    }


    public function test_delete_seed(){
        $id = Seed::all()->last()->id;
        $this->delete('/seeds/'.$id)->assertStatus(200);
    }
}
