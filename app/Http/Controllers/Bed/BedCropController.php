<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Models\Bed;

class BedCropController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Bed $bed)
    {
        $crops = $bed->plants()->with('crop')->get()->pluck('crop')->whereNotNull();
        return $this->showAll($crops);
    }


}
