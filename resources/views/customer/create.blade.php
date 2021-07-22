@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enroll New Customer</div>

                <div class="card-body">
                    <form action="/customers" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input name="name" type="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                            <small id="nameHelp" class="form-text text-muted">Enter your name</small>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input name="phone" type="phone" class="form-control" id="phone" aria-describedby="phoneHelp" placeholder="Enter Phone">
                            <small id="phoneHelp" class="form-text text-muted">Enter Phone</small>
                            @error('phone')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enroll Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
