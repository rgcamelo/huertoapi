<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\Plant;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlantCropController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $crop = $plant->crop()->get();
        return $this->showAll($crop);
    }

    public function store(Request $request, Plant $plant){

        $rules =[
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $data['plant_id'] = $plant->id;

        $crop = Crop::create($data);

        return $this->showOne($crop);
    }

    public function update(Request $request, Plant $plant, Crop $crop){
        $rules =[
            'quantity' => 'integer|min:1'
        ];

        $this->verifiedPlant($plant,$crop);

        $this->validate($request,$rules);

        $crop->fill($request->only([
            'quantity',
        ]));

        if ($crop->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $crop->save();

        return $this->showOne($crop);
    }

    public function destroy(Plant $plant, Crop $crop){
        $this->verifiedPlant($plant,$crop);

        $crop->delete();

        $this->showOne($crop);
    }

    protected function verifiedPlant(Plant $plant, Crop $crop)
    {
        if($plant->id != $crop->plant_id){
            throw new HttpException(422, 'La planta especificada no es la correcta');
        }
    }




}
