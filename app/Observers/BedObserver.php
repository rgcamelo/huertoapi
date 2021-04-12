<?php

namespace App\Observers;

use App\Models\Bed;
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
            $b = Bed::find($bed->id);
            $b->status = Bed::BED_DISPONIBLE;
            $b->save();

            $bed->plants()->delete();

        }

        if ($bed->status == 'riego') {
            $b = Bed::find($bed->id);
            $b->status = Bed::BED_DISPONIBLE;
            $b->save();

            $bed->plants->each( function($plant){
                $plant->status = 'riego';
                $plant->save();
            });
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
