<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedGardenController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seed $seed)
    {
        $gardens = $seed->plants()->with('bed.ground.garden')->get()->pluck('bed.ground.garden')->unique('id')->values();

        return $this->showAll($gardens);
    }


}
