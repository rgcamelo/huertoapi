<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantGardenController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $garden = $plant->bed->ground->garden;


        return $this->showOne($garden);
    }


}
