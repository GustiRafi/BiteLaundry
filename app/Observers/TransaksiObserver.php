<?php

namespace App\Observers;

use App\Models\transaksi;
use App\Models\log;
use App\Models\log_transaksi;
use Illuminate\Support\Facades\Auth;

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

        log_transaksi::create([
            'kode_invoice' => $transaksi->kode_invoice,
            'status' => $transaksi->status,
            'log' => 'Transaksi baru telah dibuat oleh '.Auth::user()->name 
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
        log_transaksi::create([
            'kode_invoice' => $transaksi->kode_invoice,
            'status' => $transaksi->status,
            'log' => 'Status Laundry telah diperbarui oleh '.Auth::user()->name 
        ]);
    }

    /**
     * Handle the transaksi "deleted" event.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return void
     */
    public function deleted(transaksi $transaksi)
    {
        log_transaksi::create([
            'kode_invoice' => $transaksi->kode_invoice,
            'status' => 'sudah diambil',
            'log' => 'Status Laundry telah diambil'
        ]);
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
