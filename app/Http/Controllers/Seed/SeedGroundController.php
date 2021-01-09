<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seed $seed)
    {
        $grounds = $seed->plants()->with('bed.ground')->get()->pluck('bed.ground')->unique();

        return $this->showAll($grounds);
    }

}
