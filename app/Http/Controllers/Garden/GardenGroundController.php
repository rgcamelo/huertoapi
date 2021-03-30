<?php

namespace App\Http\Controllers\Garden;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Garden;
use App\Models\Ground;
use App\Transformers\GroundTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GardenGroundController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.GroundTransformer::class)->only(['store','update']);
    }
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
            'number_bed',
            'number_furrow' ,
            'number_terrace',
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
            'status' => 'in:'.Ground::GROUND_NO_DISPONIBLE.','.Ground::GROUND_DISPONIBLE.','.Ground::GROUND_VACIO.','.Ground::GROUND_DESPLANTE.','.Ground::GROUND_RIEGO,
            'number_bed' => 'integer|min:0',
            'number_furrow' => 'integer|min:0',
            'number_terrace' => 'integer|min:0',
        ];

        $this->validate($request,$rules);

        $this->verifiedGarden($garden,$ground);

        $ground->fill($request->only([
            'name',
            'type',
            'status',
            'garden_id',
            'number_bed',
            'number_furrow',
            'number_terrace',
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
