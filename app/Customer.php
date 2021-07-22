<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name','phone', 'wallet_activated'
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function walletActivator()
    {
        $this->wallet()->create(['balance' => 0]);
        $this->wallet_activated = true;
        $this->save();
        $message = "Wallet activated Successfully!";
        $type = "success";

        return ([$type,$message]);
    }
}
