<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Models\Bed;
use Illuminate\Http\Request;

class BedGardenController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bed $bed)
    {
        $garden = $bed->ground->garden;

        return $this->showOne($garden);
    }
}
