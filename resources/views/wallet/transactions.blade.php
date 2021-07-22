@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table">
        <thead>
        <th>Sender</th>
        <th>Recipient</th>
        <th>Amount</th>
        <th>TransactionTime</th>
        <th>Sender Balance</th>
        <th>Recipient Balance</th>

        </thead>


            @foreach($transaction_list as $transaction )
            <tr>
                <td>{{$transaction->sender_name}}</td>
                <td>{{$transaction->recipient_name}}</td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->updated_at}}</td>
                <td>{{$transaction->sender_balance}}</td>
                <td>{{$transaction->recipient_balance}}</td>

            </tr>
                @endforeach

    </table>
</div>
@endsection
