<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Ground;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GroundBedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ground $ground)
    {
        $beds = $ground->beds;

        return $this->showAll($beds);
    }

    public function store(Request $request, Ground $ground)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:'.Bed::TYPE_BED.','.Bed::TYPE_FURROW.','.Bed::TYPE_TERRACE,
        ];

        if ($ground->type == Ground::TYPE_SEEDBED && $request->type != Bed::TYPE_BED) {
            return $this->errorResponse('Tipo de cama no validad',409);
        }

        if ($ground->type != Ground::TYPE_SEEDBED && $request->type == Bed::TYPE_BED) {
            return $this->errorResponse('Tipo de Zona no validad',409);
        }

        $this->validate($request,$rules);
        $data = $request->all();

        $data['status'] = Bed::BED_DISPONIBLE;
        $data['ground_id'] = $ground->id;

        if( $data['type'] == Bed::TYPE_BED){
            $ground->number_bed ++;
        }

        if( $data['type'] == Bed::TYPE_FURROW){
            $ground->number_furrow ++;
        }

        if( $data['type'] == Bed::TYPE_TERRACE){
            $ground->number_terrace ++;
        }

        $ground->save();

        $bed = Bed::create($data);

        return $this->showOne($bed,201);
    }

    public function update(Request $request, Ground $ground, Bed $bed)
    {
        $rules = [
            'type' => 'required|in:'.Bed::TYPE_BED.','.Bed::TYPE_FURROW.','.Bed::TYPE_TERRACE,
        ];

        $this->validate($request,$rules);

        $this->verifiedGround($ground,$bed);

        $bed->fill($request->only([
            'name',
            'type'
        ]));

        if ($bed->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $bed->save();

        return $this->showOne($bed);
    }

    public function destroy(Ground $ground, Bed $bed)
    {
        $this->verifiedGround($ground,$bed);

        $bed->delete();

        return $this->showOne($bed);
    }


    protected function verifiedGround(Ground $ground,Bed $bed)
    {
        if($ground->id != $bed->ground_id){
            throw new HttpException(422, 'La Zona especificada no es la correcta');
        }
    }



}
