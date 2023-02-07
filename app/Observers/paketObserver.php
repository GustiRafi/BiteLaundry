<?php

namespace App\Observers;

use App\Models\paket;
use App\Models\log;
use Illuminate\Support\Facades\Auth;

class paketObserver
{
    /**
     * Handle the paket "created" event.
     *
     * @param  \App\Models\paket  $paket
     * @return void
     */
    public function created(paket $paket)
    {
        log::create([
            'model' => 'Paket',
            'action' => 'Create',
            'log' => 'Paket '.$paket->nama.' telah ditambahkan oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the paket "updated" event.
     *
     * @param  \App\Models\paket  $paket
     * @return void
     */
    public function updated(paket $paket)
    {
        log::create([
            'model' => 'Paket',
            'action' => 'update',
            'log' => 'Paket '.$paket->nama.' di edit oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the paket "deleted" event.
     *
     * @param  \App\Models\paket  $paket
     * @return void
     */
    public function deleted(paket $paket)
    {
        log::create([
            'model' => 'Paket',
            'action' => 'Delete',
            'log' => 'Paket '.$paket->nama.' di edit oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the paket "restored" event.
     *
     * @param  \App\Models\paket  $paket
     * @return void
     */
    public function restored(paket $paket)
    {
        //
    }

    /**
     * Handle the paket "force deleted" event.
     *
     * @param  \App\Models\paket  $paket
     * @return void
     */
    public function forceDeleted(paket $paket)
    {
        //
    }
}
