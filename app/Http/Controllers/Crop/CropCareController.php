<?php

namespace App\Http\Controllers\Crop;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Crop;
use Illuminate\Http\Request;

class CropCareController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Crop $crop)
    {
        $cares = $crop->plant->cares;

        return $this->showAll($cares);
    }


}
