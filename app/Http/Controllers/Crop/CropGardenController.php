<?php

namespace App\Http\Controllers\Crop;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Crop;
use Illuminate\Http\Request;

class CropGardenController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Crop $crop)
    {
        $garden = $crop->plant->bed->ground->garden;

        return $this->showOne($garden);
    }


}
