<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Care;
use App\Models\Plant;
use App\Transformers\CareTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlantCareController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.CareTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $cares = $plant->cares;
        $cares = $cares->reverse();

        return $this->showAll($cares);
    }

    public function store(Request $request, Plant $plant){

        $rules = [
            'type' => 'required|in:'.Care::TYPE_WATER.','.Care::TYPE_EYE.
            ','.Care::TYPE_MANURE.','.Care::TYPE_PLAGUE.','.Care::TYPE_PRUNE.','.
            Care::TYPE_CROP.','.Care::TYPE_TRANSPLANTED,
            'description' => 'required|max:500'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $data['plant_id'] = $plant->id;

        $care = Care::create($data);

        return $this->showOne($care);

    }

    public function update(Request $request, Plant $plant, Care $care){

        $rules = [
            'type' => 'required|in:'.Care::TYPE_WATER.','.Care::TYPE_EYE.','.Care::TYPE_MANURE.','.Care::TYPE_PLAGUE
        ];

        $this->verifiedPlant($plant,$care);

        $this->validate($request,$rules);

        $care->fill($request->only([
            'type',
        ]));

        if ($care->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $care->save();

        return $this->showOne($care);

    }

    public function destroy(Plant $plant, Care $care){

        $this->verifiedPlant($plant,$care);

        $care->delete();

        return $this->showOne($care);
    }

    protected function verifiedPlant(Plant $plant, Care $care)
    {
        if($plant->id != $care->plant_id){
            throw new HttpException(422, 'La planta especificada no es la correcta');
        }
    }




}
