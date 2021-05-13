<?php

namespace App\Observers;

use App\Http\Controllers\Bed\BedSeedPlantController;
use App\Models\Seed;

class SeedObserver
{
    /**
     * Handle the Seed "created" event.
     *
     * @param  \App\Models\Seed  $seed
     * @return void
     */
    public function created(Seed $seed)
    {
        //
    }

    /**
     * Handle the Seed "updated" event.
     *
     * @param  \App\Models\Seed  $seed
     * @return void
     */
    public function updated(Seed $seed)
    {
        //
    }

    /**
     * Handle the Seed "deleted" event.
     *
     * @param  \App\Models\Seed  $seed
     * @return void
     */
    public function deleted(Seed $seed)
    {
        foreach($seed->plants as $plant)
            {
                $plant->status == 'desplantada';
                $plant->save();
            }
    }

    /**
     * Handle the Seed "restored" event.
     *
     * @param  \App\Models\Seed  $seed
     * @return void
     */
    public function restored(Seed $seed)
    {
        //
    }

    /**
     * Handle the Seed "force deleted" event.
     *
     * @param  \App\Models\Seed  $seed
     * @return void
     */
    public function forceDeleted(Seed $seed)
    {
        //
    }
}
