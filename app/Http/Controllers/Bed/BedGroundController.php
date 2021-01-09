<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Models\Bed;

class BedGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bed $bed)
    {
        $ground = $bed->ground;

        return $this->showOne($ground);
    }
}
