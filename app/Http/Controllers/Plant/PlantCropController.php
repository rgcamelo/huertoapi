<?php

namespace App\Http\Controllers\Plant;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Models\Plant;
use App\Transformers\CropTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlantCropController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.CropTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plant $plant)
    {
        $crops = $plant->crops()->get();
        return $this->showAll($crops);
    }

    public function store(Request $request, Plant $plant){

        $rules =[
            'quantity' => 'required',
            'care_id' => 'required'
        ];

        $this->validate($request,$rules);

        $data = $request->all();

        $data['plant_id'] = $plant->id;

        $crop = Crop::create($data);

        return $this->showOne($crop);
    }

    public function update(Request $request, Plant $plant, Crop $crop){
        $rules =[
            'quantity'
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
