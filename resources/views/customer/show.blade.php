@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$customer->name}}</div>
                <a href="/customers/{{$customer->id}}/wallet_activation" class="btn btn-dark"> Show Wallet</a>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
