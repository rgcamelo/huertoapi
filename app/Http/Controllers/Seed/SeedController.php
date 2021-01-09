<?php

namespace App\Http\Controllers\Seed;

use App\Http\Controllers\ApiController;
use App\Models\Seed;
use Illuminate\Http\Request;

class SeedController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seeds = Seed::all();

        return $this->showAll($seeds);
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

        $seed = Seed::create($request->all());
        return $this->showOne($seed,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seed $seed)
    {
        return $this->showOne($seed);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seed $seed)
    {
        $seed->fill($request->only([
            'name',
            'status',
        ]));

        if ($seed->isClean()) {
            return $this->errorResponse('Debe especificar al menor un valor diferente para actualizar',422);
        }

        $seed->save();

        return $this->showOne($seed);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seed $seed)
    {
        $seed->delete();

        return $this->showOne($seed);
    }
}
