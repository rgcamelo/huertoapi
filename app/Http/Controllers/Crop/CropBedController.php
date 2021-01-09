<?php

namespace App\Http\Controllers\Crop;

use App\Http\Controllers\ApiController;
use App\Models\Crop;

class CropBedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Crop $crop)
    {
        $bed = $crop->plant->bed;

        return $this->showOne($bed);
    }


}
