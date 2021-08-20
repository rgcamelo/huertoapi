<?php

namespace App\Http\Controllers\Ground;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Ground;
use App\Transformers\BedTransformer;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\DB;

class GroundBedController extends ApiController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware('transform.input:'.BedTransformer::class)->only(['store','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ground $ground)
    {
        $beds = $ground->beds;
        $beds = $beds->sortBy('number');

        return $this->showAll($beds);
    }

    public function store(Request $request, Ground $ground)
    {
        $rules = [
            'name' => 'required',
            'number' => 'required|integer',
            'x' => 'required|integer',
            'y' => 'required|integer',
            'type' => 'required|in:'.Bed::TYPE_BED.','.Bed::TYPE_FURROW.','.Bed::TYPE_TERRACE,
        ];

        if ($ground->type == Ground::TYPE_SEEDBED && $request->type != Bed::TYPE_BED) {
            return $this->errorResponse('Tipo de cama no validad',409);
        }

        if ($ground->type != Ground::TYPE_SEEDBED && $request->type == Bed::TYPE_BED) {
            return $this->errorResponse('Tipo de Zona no validad',409);
        }

        $this->validate($request,$rules);

        return DB::transaction(function () use($request,$ground) {

            // $nx = number_format($request->x, 2, '.', '');
            // $ny = number_format($request->y, 2, '.', '');


            $data = $request->all();

            $data['status'] = Bed::BED_DISPONIBLE;
            $data['ground_id'] = $ground->id;
            // $data['x'] = $nx;
            // $data['y'] = $ny;

            $bed = Bed::create($data);

            return $this->showOne($bed,201);
        });


        // if( $data['type'] == Bed::TYPE_BED){
        //     $ground->number_bed ++;
        // }

        // if( $data['type'] == Bed::TYPE_FURROW){
        //     $ground->number_furrow ++;
        // }

        // if( $data['type'] == Bed::TYPE_TERRACE){
        //     $ground->number_terrace ++;
        // }

        // $ground->save();


    }

    public function update(Request $request, Ground $ground, Bed $bed)
    {

        $rules = [
            'name',
            'type' => 'in:'.Bed::TYPE_BED.','.Bed::TYPE_FURROW.','.Bed::TYPE_TERRACE,
            'status' => 'in:'.Bed::BED_VOID.','.Bed::BED_DISPONIBLE.','.Bed::BED_NO_DISPONIBLE.','.Bed::BED_WATER,
        ];

        $this->validate($request,$rules);

        $this->verifiedGround($ground,$bed);

        $bed->fill($request->only([
            'name',
            'type',
            'status',
        ]));

        if ($bed->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $bed->save();

        return $this->showOne($bed);
    }

    public function destroy(Ground $ground, Bed $bed)
    {
        return DB::transaction(function () use($ground,$bed) {
            $this->verifiedGround($ground,$bed);
            $bed->delete();
            return $this->showOne($bed);
        });
    }


    protected function verifiedGround(Ground $ground,Bed $bed)
    {
        if($ground->id != $bed->ground_id){
            throw new HttpException(422, 'La Zona especificada no es la correcta');
        }
    }



}
