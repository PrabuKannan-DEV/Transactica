@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <form action="/wallets/{{$wallet->id}}/credit" method="post">
                    @csrf
                    <div class="form-group col-sm-4">
                        <label for="amount">Enter amount</label>
                        <input name="amount" type="amount" class="form-control" id="amount" aria-describedby="amountHelp"
                               placeholder="Enter amount to credit">
                        @error('amount')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Credit</button>
                </form>

            </div>
        </div>
    </div>
@endsection
