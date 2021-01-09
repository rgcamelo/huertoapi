<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $ground = $plant->bed->ground;

        return $this->showOne($ground);
    }


}
