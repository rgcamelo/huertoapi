<?php

namespace App\Http\Controllers\Care;

use App\Http\Controllers\ApiController;
use App\Models\Care;

class CarePlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Care $care)
    {
        $plant = $care->plant;

        return $this->showOne($plant);
    }


}
