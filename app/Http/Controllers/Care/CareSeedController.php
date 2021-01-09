<?php

namespace App\Http\Controllers\Care;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Care;
use Illuminate\Http\Request;

class CareSeedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Care $care)
    {
        $seed = $care->plant->seed;

        return $this->showOne($seed);
    }


}
