<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Void_;


class Wallet extends Model
{
    protected $guarded=[];

    protected $fillable=['balance'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }

    public function credit($amount)
    {
        $new_bal = $this->balance + $amount;
        $this->balance=$new_bal;
        $this->save();

        $this->transaction_register(
            $recipient_wallet=$this,
            $amount,
            $sender_wallet=0
        );
        $message = "Your Account has been credited successfully";
        return ([$message]);
    }

    public function withdrawal($amount)
    {
        if ($this->balance < $amount) {
            $message = "Insufficient Balance!, please make inward transactions to proceed...";
            $type = 'danger';
        } else {
            $new_bal = $this->balance - $amount;
            $this->balance=$new_bal;
            $this->save();            $this->transaction_register( $recipient_wallet=0,
                $amount,
                $sender_wallet=$this);
            $message = "Withdrawal Successful...!";
            $type = 'success';
        }
        return ([$type,$message]);
    }

    public function transfer($recipient_id, $amount )
    {
        $recipient = Customer::findOrFail($recipient_id);
        if ($recipient->wallet_activated==1) {

            $recipient_wallet = $recipient->wallet;
            if ($this->balance < $amount) {
                $message = "Insufficient Balance!, please make inward transactions to proceed...";
                $type = "danger";
            } else {

                //      Debiting
                $this->balance -= $amount;
                $this->save();
                //      Crediting
                $recipient_wallet->balance += $amount;
                $recipient_wallet->save();

                $this->transaction_register(
                    $recipient_wallet,
                    $amount,
                    $sender_wallet=$this
                );
                $type = "success";
                $message = "Transaction completed Successfully!";
            }
        } else {
            $message = "Transaction failed!, Recipient wallet is not activated";
            $type = "danger";
        }
        return ([$type, $message]);
    }

    public function transaction_register($recipient_wallet, $amount, $sender_wallet)
    {

        if (!is_object($recipient_wallet)){
            $recipient_name="Withdrawal";
            $recipient_balance="0";
        }else{
            $recipient_name=$recipient_wallet->customer->name;
            $recipient_balance=$recipient_wallet->balance;
        }
        if (!is_object($sender_wallet)){
            $sender_name="Credit";
            $sender_balance=0;
        }else{
            $sender_name=$sender_wallet->customer->name;
            $sender_balance=$sender_wallet->balance;
        }
        Transactions::create([
            'sender_name'=>$sender_name,
            'recipient_name'=>$recipient_name,
            'amount' => $amount,
            'sender_balance' => $sender_balance,
            'recipient_balance' => $recipient_balance,
        ])->save();

    }

 }
