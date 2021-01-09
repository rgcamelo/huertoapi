<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantCareController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $cares = $plant->cares;

        return $this->showAll($cares);
    }


}
