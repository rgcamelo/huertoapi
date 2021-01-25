<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use Illuminate\Http\Request;

class GardenSeedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $seeds = $garden->grounds()->with('beds.plants.seed')->get()->pluck('beds')->collapse()->pluck('plants')->collapse()->pluck('seed');

        return $this->showAll($seeds);
    }


}
