<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Models\Bed;

class BedPlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bed $bed)
    {
        $plants = $bed->plants;
        return $this->showAll($plants);
    }


}
