<?php

namespace App\Http\Controllers\Care;

use App\Http\Controllers\ApiController;
use App\Models\Care;

class CareGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Care $care)
    {
        $ground = $care->plant->bed->ground;
        return $this->showOne($ground);
    }


}
