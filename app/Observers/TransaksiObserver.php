<?php

namespace App\Observers;

use App\Models\transaksi;

class TransaksiObserver
{
    /**
     * Handle the transaksi "created" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function created(transaksi $transaksi)
    {
        log::create([
            'model' => 'Transaksi',
            'action' => 'Create',
            'log' => 'Transaksi baru telah dibuat oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the transaksi "updated" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function updated(transaksi $transaksi)
    {
        //
    }

    /**
     * Handle the transaksi "deleted" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function deleted(transaksi $transaksi)
    {
        //
    }

    /**
     * Handle the transaksi "restored" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function restored(transaksi $transaksi)
    {
        //
    }

    /**
     * Handle the transaksi "force deleted" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function forceDeleted(transaksi $transaksi)
    {
        //
    }
}
