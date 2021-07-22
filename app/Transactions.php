<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded=[];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
