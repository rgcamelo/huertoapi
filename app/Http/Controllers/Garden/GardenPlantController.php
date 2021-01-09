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
        $plants = $garden->grounds()->with('beds.plant')->get()->pluck('beds')->collapse()->pluck('plant');

        return $this->showAll($plants);
    }

}
