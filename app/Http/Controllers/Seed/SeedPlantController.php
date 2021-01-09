<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedPlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seed $seed)
    {
        $plants = $seed->plants;

        return $this->showAll($plants);
    }

}
