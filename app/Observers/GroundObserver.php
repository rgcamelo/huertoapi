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
            $ground->beds()->delete();
            $ground->status = Ground::GROUND_DISPONIBLE;
            $ground->save();
        }

        if ($ground->status == 'desplante') {

            $ground->beds->each( function($bed){
                $bed->status = 'vacio';
                $bed->save();
            });
            $ground->status = Ground::GROUND_DISPONIBLE;
            $ground->save();
        }

        if ($ground->status == 'riego') {
            $ground->beds->each( function($bed){
                $bed->status = 'riego';
                $bed->save();
            });
            $ground->status = Ground::GROUND_DISPONIBLE;
            $ground->save();
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
        //
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
