<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Ground;
use Illuminate\Http\Request;

class GroundCareController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ground $ground)
    {
        $cares = $ground->beds()->with('plant.cares')->get()->pluck('plant.cares')->collapse();

        return $this->showAll($cares);
    }
}
