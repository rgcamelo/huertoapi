<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Models\Plant;


class PlantBedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $bed = $plant->bed;
        return $this->showOne($bed);
    }

}
