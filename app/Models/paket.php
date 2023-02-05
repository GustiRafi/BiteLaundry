<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    // protected $with =['outlet'];

    public function outlet()
    {
        return $this->belongsTo(outlet::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(detail_transaksi::class);
    }
}
