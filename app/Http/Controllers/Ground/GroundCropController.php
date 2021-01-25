<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Ground;
use Illuminate\Http\Request;

class GroundCropController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ground $ground)
    {
        $crops = $ground->beds()->with('plants.crop')->get()->pluck('plants')->collapse()->pluck('crop')->whereNotNull()->values();
        return $this->showAll($crops);
    }


}
