@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{-- <a href="/customers"/create" class="btn btn-dark">Enroll New Customer</a> --}}
                        <a href="{{route("customer.create")}}" class="btn btn-dark">Enroll New Customer</a>
                    </div>
            </div>
            <div class="form-group col">
                <label for="search_recipient">Customer Lookup</label>
                @csrf
                <input name="search_recipient" type="text" class="typeahead form-control"
                       id="search_recipient"
                       aria-describedby="search_recipientHelp"
                       placeholder="Enter recipient to transfer">
            </div>
                <table class="table ">
                    <thead>
                        <tr>
                            <th id="customer_name">Customer Name</th>
                            <th id="phone">Phone</th>
                            <th id="wallet_status">Walllet Status</th>
                            <th id="view">View</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic_content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('partials.dashboardSearch')
@endsection

