<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Models\Seed;

class SeedBedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seed $seed)
    {
        $bed = $seed->plants()->with('bed')->get()->pluck('bed');

        return $this->showAll($bed);
    }

}
