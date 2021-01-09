<?php

namespace App\Http\Controllers\Crop;

use App\Http\Controllers\ApiController;
use App\Models\Crop;


class CropSeedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Crop $crop)
    {
        $seed = $crop->plant->seed;

        return $this->showOne($seed);
    }

}
