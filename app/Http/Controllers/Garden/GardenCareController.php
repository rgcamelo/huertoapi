<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use Illuminate\Http\Request;

class GardenCareController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $cares = $garden->grounds()->with('beds.plants.cares')->get()->pluck('beds')->collapse()->pluck('plants')->collapse()->pluck('cares')->collapse();

        return $this->showAll($cares);
    }

}
