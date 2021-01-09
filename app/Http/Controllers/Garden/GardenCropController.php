<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use Illuminate\Http\Request;

class GardenCropController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $crops = $garden->grounds()->with('beds.plant.crop')->get()->pluck('beds')->collapse()->pluck('plant.crop');

        return $this->showAll($crops);
    }


}
