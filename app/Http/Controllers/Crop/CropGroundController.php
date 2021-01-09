<?php

namespace App\Http\Controllers\Crop;

use App\Http\Controllers\ApiController;
use App\Models\Crop;

class CropGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Crop $crop)
    {
        $ground = $crop->plant->bed->ground;

        return $this->showOne($ground);
    }
}
