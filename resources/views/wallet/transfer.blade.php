@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="/wallets/{{$wallet->id}}/transfer" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="search_recipient">Search recepient</label>
                            <input name="search_recipient" type="text" class="typeahead form-control"
                                   id="search_recipient"
                                   aria-describedby="search_recipientHelp"
                                   placeholder="Enter recipient to transfer">

                            @error('search_recipient')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="bg-white" id="recipientList"></div>
                        </div>
                        <div class="form-group col">
                            <label for="amount">Enter amount</label>
                            <input name="amount" type="text" class="form-control" id="amount"
                                   aria-describedby="amountHelp"
                                   placeholder="Enter amount to transfer">
                            @error('amount')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Recepient Details</span>
                            </div>
                            <input name="recipient_details" type="text" class="form-control" id="recipient_details" aria-describedby="basic-addon3"
                                   >
                            @error('recipient_details')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="input-group mb-3 col">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Recipient ID</span>
                            </div>
                            <input name="recipient_id" type="text" class="form-control" id="recipient_id" aria-describedby="basic-addon3"
                                   >
                            @error('recipient_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </form>
            </div>
        </div>
    </div>
  @include('partials.transferSearch')
@endsection

