<?php

namespace App\Observers;

use App\Models\Parents;

class ParentObserver
{
    /**
     * Handle the Parents "created" event.
     *
     * @param  \App\Models\Parents  $parents
     * @return void
     */
    public function created(Parents $parents)
    {
        //
    }

    /**
     * Handle the Parents "updated" event.
     *
     * @param  \App\Models\Parents  $parents
     * @return void
     */
    public function updated(Parents $parents)
    {
        $parents->enfants()->update(['status'=> $parents->status]);
    }

    /**
     * Handle the Parents "deleted" event.
     *
     * @param  \App\Models\Parents  $parents
     * @return void
     */
    public function deleted(Parents $parents)
    {

    }

    /**
     * Handle the Parents "restored" event.
     *
     * @param  \App\Models\Parents  $parents
     * @return void
     */
    public function restored(Parents $parents)
    {
        //
    }

    /**
     * Handle the Parents "force deleted" event.
     *
     * @param  \App\Models\Parents  $parents
     * @return void
     */
    public function forceDeleted(Parents $parents)
    {
        //
    }
}
