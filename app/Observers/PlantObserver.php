<?php

namespace App\Observers;

use App\Models\Care;
use App\Models\Plant;

class PlantObserver
{
    /**
     * Handle the Plant "created" event.
     *
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function created(Plant $plant)
    {
        $data = [
            'plant_id' => $plant->id,
            'type' => 'Plantada',
            'description' => 'Dia de Plantada'
        ];

        $care = Care::create($data);
    }

    /**
     * Handle the Plant "updated" event.
     *
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function updated(Plant $plant)
    {

    }

    /**
     * Handle the Plant "deleted" event.
     *
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function deleted(Plant $plant)
    {
        //
    }

    /**
     * Handle the Plant "restored" event.
     *
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function restored(Plant $plant)
    {
        //
    }

    /**
     * Handle the Plant "force deleted" event.
     *
     * @param  \App\Models\Plant  $plant
     * @return void
     */
    public function forceDeleted(Plant $plant)
    {
        //
    }
}
