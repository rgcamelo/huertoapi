<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use Illuminate\Http\Request;

class GardenPlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $plants = $garden->grounds()->with('beds.plants')->get()->pluck('beds')->collapse()->pluck('plants')->collapse();
        return $this->showAll($plants);
    }

}
