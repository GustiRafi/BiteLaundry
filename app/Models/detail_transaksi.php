<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with =['paket','transaksi'];

    public function transaksi()
    {
        return $this->hasOne(transaksi::class,'id','id_transaksi');
    }

    public function paket()
    {
        return $this->hasOne(paket::class, 'id','id_paket');
    }
}
