<?php

namespace App\Observers;

use App\Models\Ground;

class GroundObserver
{
    /**
     * Handle the Ground "created" event.
     *
     * @param  \App\Models\Ground  $ground
     * @return void
     */
    public function created(Ground $ground)
    {
        //
    }

    /**
     * Handle the Ground "updated" event.
     *
     * @param  \App\Models\Ground  $ground
     * @return void
     */
    public function updated(Ground $ground)
    {
        if ($ground->status == 'vacio') {
            $g = Ground::find($ground->id);
            $g->status = Ground::GROUND_DISPONIBLE;
            $g->save();

            $ground->beds()->delete();

        }

        if ($ground->status == 'desplante') {
            $g = Ground::find($ground->id);
            $g->status = Ground::GROUND_DISPONIBLE;
            $g->save();

            $ground->beds->each( function($bed){
                $bed->status = 'vacio';
                $bed->save();
            });

        }

        if ($ground->status == 'riego') {
            $g = Ground::find($ground->id);
            $g->status = Ground::GROUND_DISPONIBLE;
            $g->save();

            $ground->beds->each( function($bed){
                $bed->status = 'riego';
                $bed->save();
            });

        }


    }

    /**
     * Handle the Ground "deleted" event.
     *
     * @param  \App\Models\Ground  $ground
     * @return void
     */
    public function deleted(Ground $ground)
    {
        $ground->beds()->delete();
    }

    /**
     * Handle the Ground "restored" event.
     *
     * @param  \App\Models\Ground  $ground
     * @return void
     */
    public function restored(Ground $ground)
    {
        //
    }

    /**
     * Handle the Ground "force deleted" event.
     *
     * @param  \App\Models\Ground  $ground
     * @return void
     */
    public function forceDeleted(Ground $ground)
    {
        //
    }
}
