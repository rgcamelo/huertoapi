<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Models\Garden;
use Illuminate\Http\Request;

class GardenController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gardens = Garden::all();

        return $this->showAll($gardens);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $this->validate($request,$rules);

        $garden = Garden::create($request->all());
        return $this->showOne($garden,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Garden $garden)
    {
        return $this->showOne($garden);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garden $garden)
    {
        $garden->fill($request->only([
            'name',
            'status',
        ]));

        if ($garden->isClean()) {
            return $this->errorResponse('Debe especificar al menor un valor diferente para actualizar',422);
        }

        $garden->save();

        return $this->showOne($garden);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garden $garden)
    {
        $garden->delete();

        return $this->showOne($garden);
    }
}
