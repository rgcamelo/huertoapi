<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Ground;
use Illuminate\Http\Request;

class GroundPlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ground $ground)
    {
        $plants = $ground->beds()->with('plants')->get()->pluck('plants')->collapse();
        return $this->showAll($plants);
    }


}
