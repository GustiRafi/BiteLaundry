<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class outlet extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function user()
    {
        return $this->hasMany(user::class);
    }

    public function paket()
    {
        return $this->hasMany(paket::class);
    }
}
