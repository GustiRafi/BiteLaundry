<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_transaksi()
    {
        return $this->belongsTo(detail_transaksi::class);
    }

    public function member()
    {
        return $this->hasOne(member::class,'id','id_member');
    }
    public function outlet()
    {
        return $this->hasOne(outlet::class,'id','id_outlet');
    }
}
