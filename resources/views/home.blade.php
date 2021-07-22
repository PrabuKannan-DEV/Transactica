<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
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
                            <a href="/customers/create" class="btn btn-dark">Enroll New Customer</a>
                            <a href="/customers/show" class="btn btn-dark">Lookup Customers</a>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="search_recipient">Customer Lookup</label>
                        @csrf
                        <input name="search_recipient" type="text" class="form-control"
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
    </main>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
    document.getElementById("#dynamic_content").innerHTML = "My First JavaScript";
</script>


<script>$(".card-header").mouseover(function () {
        (function () {
            alert("this works");
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('#search_recipient').keyup(function () {
            console.log("workd");
            var query = $(this).val();
            if (query != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var _token = $('input[name="_token').val();
                $.ajax({
                        url: "{{route('search_recipient')}}",
                        method: "POST",
                        data: {query: query, _token: _token},
                        success: function (data) {
                            data = JSON.parse(data);
                            var element = '';
                            $.each(data, function (index, value) {
                                element = '<tr>' +
                                    '<td>' + value.name + '</td>' +
                                    '<td>' + value.phone + '</td>' +
                                    '<td>' + value.wallet_activated + "</td>"
                                "<td><a href='/customers/" + value.id +
                                "class='btn btn - primary'></a></td></tr>";
                            });
                            $('#dynamic_content').append(element);
                        }
                    }
                );
            }
        });
    });


</script>

</body>

</html>

