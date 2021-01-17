<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use App\Models\Ground;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GardenGroundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Garden $garden)
    {
        $grounds = $garden->grounds;

        return $this->showAll($grounds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Garden $garden)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:'.Ground::TYPE_MODULE.','.Ground::TYPE_SEEDBED,
        ];

        $this->validate($request,$rules);

        $data = $request->all();
        $data['status'] = Ground::GROUND_DISPONIBLE;
        $data['garden_id'] = $garden->id;


        $ground = Ground::create($data);

        return $this->showOne($ground,201);
    }

    public function update(Request $request, Garden $garden, Ground $ground)
    {
        $rules = [
            'type' => 'in:'.Ground::TYPE_MODULE.','.Ground::TYPE_SEEDBED,
        ];

        $this->validate($request,$rules);

        $this->verifiedGarden($garden,$ground);

        $ground->fill($request->only([
            'name',
            'type',
            'garden_id'
        ]));

        if ($ground->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $ground->save();

        return $this->showOne($ground);

    }

    public function destroy(Garden $garden,Ground $ground){

        $this->verifiedGarden($garden,$ground);

        $ground->delete();

        return $this->showOne($ground);
    }

    protected function verifiedGarden( Garden $garden, Ground $ground)
    {
        if($garden->id != $ground->garden_id){
            throw new HttpException(422, 'El Huerto especificado no es el huerto real');
        }
    }
}
