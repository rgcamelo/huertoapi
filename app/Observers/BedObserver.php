<?php

namespace App\Observers;

use App\Models\Bed;
use App\Models\Ground;
use Illuminate\Support\Facades\DB;

class BedObserver
{
    /**
     * Handle the Bed "created" event.
     *
     * @param  \App\Models\Bed  $bed
     * @return void
     */
    public function created(Bed $bed)
    {
        //
    }

    /**
     * Handle the Bed "updated" event.
     *
     * @param  \App\Models\Bed  $bed
     * @return void
     */
    public function updated(Bed $bed)
    {
        if ($bed->status == 'vacio') {
            $bed->plants()->delete();
            $bed->status = 'disponible';
            $bed->save();
        }

        if ($bed->status == 'riego') {
            $bed->plants->each( function($plant){
                $plant->status = 'riego';
                $plant->save();
            });
            $bed->status = Bed::BED_DISPONIBLE;
            $bed->save();
        }
    }

    /**
     * Handle the Bed "deleted" event.
     *
     * @param  \App\Models\Bed  $bed
     * @return void
     */
    public function deleted(Bed $bed)
    {
        $bed->plants()->delete();
    }


    /**
     * Handle the Bed "restored" event.
     *
     * @param  \App\Models\Bed  $bed
     * @return void
     */
    public function restored(Bed $bed)
    {
        //
    }

    /**
     * Handle the Bed "force deleted" event.
     *
     * @param  \App\Models\Bed  $bed
     * @return void
     */
    public function forceDeleted(Bed $bed)
    {
        //
    }
}
