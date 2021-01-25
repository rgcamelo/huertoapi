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
        $cares = $ground->beds()->with('plants.cares')->get()->pluck('plants')->collapse()->pluck('cares')->collapse();
        return $this->showAll($cares);
    }
}
