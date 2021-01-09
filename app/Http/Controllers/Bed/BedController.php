<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Models\Bed;
use Illuminate\Http\Request;

class BedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = Bed::all();

        return $this->showAll($beds);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        return $this->showOne($bed);
    }

}
