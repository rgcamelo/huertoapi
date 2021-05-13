<?php

namespace App\Observers;

use App\Models\Garden;

class GardenObserver
{
    /**
     * Handle the Garden "created" event.
     *
     * @param  \App\Models\Garden  $garden
     * @return void
     */
    public function created(Garden $garden)
    {
        //
    }

    /**
     * Handle the Garden "updated" event.
     *
     * @param  \App\Models\Garden  $garden
     * @return void
     */
    public function updated(Garden $garden)
    {
        //
    }

    /**
     * Handle the Garden "deleted" event.
     *
     * @param  \App\Models\Garden  $garden
     * @return void
     */
    public function deleted(Garden $garden)
    {
        $garden->grounds()->delete();
    }

    /**
     * Handle the Garden "restored" event.
     *
     * @param  \App\Models\Garden  $garden
     * @return void
     */
    public function restored(Garden $garden)
    {
        //
    }

    /**
     * Handle the Garden "force deleted" event.
     *
     * @param  \App\Models\Garden  $garden
     * @return void
     */
    public function forceDeleted(Garden $garden)
    {
        //
    }
}
