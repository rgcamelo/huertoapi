<?php

namespace App\Http\Controllers\Bed;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Plant;
use App\Models\Seed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BedSeedPlantController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Bed $bed,Seed $seed)
    {
        if (!$bed->isDisponible()) {
            return $this->errorResponse('La cama no esta disponible',409);
        }

        if (!$seed->isDisponible()){
            return $this->errorResponse('Semilla no disponible',409);
        }

        $rules =[
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request,$rules);

        return DB::transaction(function () use ($request,$bed,$seed) {
            // if ($bed->type != Bed::TYPE_BED) {
            //     $bed->status = Bed::BED_NO_DISPONIBLE;
            //     $bed->save();
            // }

            $data = $request->all();
            $data['name'] = $seed->name;
            $data['bed_id'] = $bed->id;
            $data['seed_id'] = $seed->id;

            $plant = Plant::create($data);

            return $this->showOne($plant,201);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Bed $bed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed, Seed $seed, Plant $plant)
    {
        if($request->bed_id){
            if($plant->bed_id == $request->bed_id){
                return $this->errorResponse('La cama es la misma',409);
            }

            if (!Bed::find($request->bed_id)->isDisponible()) {
                return $this->errorResponse('La cama no esta disponible',409);
            }
        }

        $rules = [
            'status' => 'in:'.Plant::PLANT_STATUS_PLANTED.','.Plant::PLANT_STATUS_WATER.','.Plant::PLANT_STATUS_DESPLANTED.','.Plant::PLANT_STATUS_DISPONIBLE.','.Plant::PLANT_STATUS_NO_DISPONIBLE.','.Plant::PLANT_TRANSPLANTED,
        ];

        $this->validate($request,$rules);

        $this->verifiedSeedBed($bed,$seed,$plant);

        if ($request->status === 'transplantada') {
            $bed -> Bed::find($request->bed_id);
            $seed -> Seed::find($request->seed_id);


            $newplant = $this->store($request,$bed,$seed);
            // foreach($plant->cares as $care)
            // {

            //     $transp->cares()->attach($care);
            // }

            // $transp->push();

            return $newplant;

        }else{

            $plant->fill($request->only([
                'bed_id',
                'status'
            ]));

            if ($plant->isClean()) {
                return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
            }

            $plant->save();

            return $this->showOne($plant);
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bed  $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bed $bed, Seed $seed, Plant $plant)
    {
        $this->verifiedSeedBed($bed,$seed,$plant);

        $plant->status = 'no disponible';
        $plant->save();
        $plant->delete();

        return $this->showOne($plant);

    }

    protected function verifiedSeedBed( Bed $bed, Seed $seed, Plant $plant)
    {
        if($bed->id != $plant->bed_id ){
            throw new HttpException(422, 'La cama especificada no es la correcta');
        }

        if ($seed->id != $plant->seed_id) {
            throw new HttpException(422, 'La semilla especificada no es la correcta');
        }
    }
}
