@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            {{$wallet->customer->name}}'s Wallet
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Balance</h5>
                            <p class="card-text">{{$wallet->balance}}</p>
                            <a href="/wallets/{{$wallet->id}}/credit" class="btn btn-success">Credit</a>
                            <a href="/wallets/{{$wallet->id}}/withdraw" class="btn btn-primary">Withdraw</a>
                            <a href="/wallets/{{$wallet->id}}/transfer" class="btn btn-warning">Transfer</a>
                            <br><br>
                        <a href="{{route('transactions',[$wallet->id])}}" class="btn btn-secondary">See Transactions >></a>

                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
