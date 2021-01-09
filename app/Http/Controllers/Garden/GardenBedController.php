<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Models\Garden;

class GardenBedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $beds = $garden->grounds()->with('beds')->get()->pluck('beds')->collapse();
        return $this->showAll($beds);
    }

}
