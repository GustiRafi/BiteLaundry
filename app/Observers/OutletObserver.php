<?php

namespace App\Observers;

use App\Models\outlet;
use App\Models\log;
use Illuminate\Support\Facades\Auth;

class OutletObserver
{
    /**
     * Handle the outlet "created" event.
     *
     * @param  \App\Models\outlet  $outlet
     * @return void
     */
    public function created(outlet $outlet)
    {
        //
    }

    /**
     * Handle the outlet "updated" event.
     *
     * @param  \App\Models\outlet  $outlet
     * @return void
     */
    public function updated(outlet $outlet)
    {
        log::create([
            'model' => 'Outlet',
            'action' => 'update',
            'log' => 'Outlet di edit oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the outlet "deleted" event.
     *
     * @param  \App\Models\outlet  $outlet
     * @return void
     */
    public function deleted(outlet $outlet)
    {
        //
    }

    /**
     * Handle the outlet "restored" event.
     *
     * @param  \App\Models\outlet  $outlet
     * @return void
     */
    public function restored(outlet $outlet)
    {
        //
    }

    /**
     * Handle the outlet "force deleted" event.
     *
     * @param  \App\Models\outlet  $outlet
     * @return void
     */
    public function forceDeleted(outlet $outlet)
    {
        //
    }
}
