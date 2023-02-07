<?php

namespace App\Observers;

use App\Models\member;
use App\Models\log;
use Illuminate\Support\Facades\Auth;

class memberObserver
{
    /**
     * Handle the member "created" event.
     *
     * @param  \App\Models\member  $member
     * @return void
     */
    public function created(member $member)
    {
        log::create([
            'model' => 'member',
            'action' => 'Create',
            'log' => 'Memeber baru telah  ditambahkan oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the member "updated" event.
     *
     * @param  \App\Models\member  $member
     * @return void
     */
    public function updated(member $member)
    {
        log::create([
            'model' => 'member',
            'action' => 'update',
            'log' => 'Member '.$member->nama.' di edit oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the member "deleted" event.
     *
     * @param  \App\Models\member  $member
     * @return void
     */
    public function deleted(member $member)
    {
        log::create([
            'model' => 'Outlet',
            'action' => 'delete',
            'log' => 'Outlet '.$outlet->nama.' di haapus oleh '.Auth::user()->name ,
            'id_user' => Auth::user()->id,
        ]);
    }

    /**
     * Handle the member "restored" event.
     *
     * @param  \App\Models\member  $member
     * @return void
     */
    public function restored(member $member)
    {
        //
    }

    /**
     * Handle the member "force deleted" event.
     *
     * @param  \App\Models\member  $member
     * @return void
     */
    public function forceDeleted(member $member)
    {
        //
    }
}
