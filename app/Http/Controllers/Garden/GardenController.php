<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Models\Garden;
use App\Transformers\GardenTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GardenController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.GardenTransformer::class)->only(['store','update']);
    }
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
            'name' => 'required',
            'image' => 'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $garden = Garden::create($data);
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
            'image',
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
        $garden['status'] = Garden::GARDEN_NO_DISPONIBLE;

        $garden->delete();

        return $this->showOne($garden);
    }
}
