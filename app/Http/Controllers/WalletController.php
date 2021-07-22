<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreditRequest;
use App\Http\Requests\TransferRequest;
use App\Http\Requests\WithdrawlRequest;
use App\Transactions;
use App\Wallet;

class WalletController extends Controller
{

    public function show(Wallet $wallet)
    {
        [$type, $message] = [request('type'), request('message')];
        return view('wallet.show', compact('wallet', 'message', 'type'));
    }

    public function creditPage(Wallet $wallet)
    {
        return view('wallet.credit', compact('wallet'));
    }

    public function creditHandler(Wallet $wallet, CreditRequest $request)
    {
        [$message] = $wallet->credit($request->amount);
        return redirect()->route('show_wallet', ['wallet' => $wallet])->with('success', $message);
    }

    public function withdrawPage(Wallet $wallet)
    {
        return view('wallet.withdraw', compact('wallet'));
    }

    public function withdrawalHandler(Wallet $wallet, WithdrawlRequest $request)
    {
        [$type, $message] = $wallet->withdrawal($request->amount);
        return redirect()->route('show_wallet', ['wallet' => $wallet])->with($type, $message);
    }

    public function transferPage(Wallet $wallet)
    {
        return view('wallet.transfer', compact('wallet'));
    }

    public function transfer(Wallet $wallet, TransferRequest $request)
    {
        [$type, $message] = $wallet->transfer($request->recipient_id, $request->amount);
        return redirect()->route('show_wallet', ['wallet' => $wallet])->with($type, $message);
    }

    public function transactions(Wallet $wallet)
    {
        $transaction_list = Transactions::where('sender_name', '=', $wallet->customer->name)
            ->orWhere('recipient_name', '=', $wallet->customer->name)
            ->get();
        return view("wallet.transactions", compact('transaction_list'));
    }
}
