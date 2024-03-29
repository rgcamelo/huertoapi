<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedCropController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seed $seed)
    {
        $crops = $seed->plants()->withTrashed()->whereHas('crops')->with('crops')->get()->pluck('crops')->collapse();
        $crops = $crops->reverse();

        return $this->showAll($crops);
    }

}
