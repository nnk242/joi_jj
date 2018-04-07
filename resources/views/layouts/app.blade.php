<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Common -->
    <link href="{{ asset('common/style.css') }}" rel="stylesheet">
    <!-- Font awesome styles -->
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    @yield('stylesheet')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                Anhxxx.net
            </a>
            @if (!Auth::guest())
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('dashboard')}}">Dashboard <span
                                        class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view.image')}}">Image</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view.group')}}">Group</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('view.tag')}}">Tag</a>
                        </li>
                    </ul>
                </div>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @if (!Auth::guest())
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <a data-toggle="modal" data-target="#changePassword" class="dropdown-item">
                                    Change Password
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>

    @yield('contents')
</div>

<!-- The Modal -->
<div class="modal fade" id="changePassword">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('changePassword') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pwold">Password old:</label>
                        <input type="password" class="form-control" id="pwold" name="current-password" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd1">Password new:</label>
                        <input type="password" class="form-control" id="pwd1" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Confirm Password new:</label>
                        <input type="password" class="form-control" id="pwd2" name="password_confirmation" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
<script>
    var pwd1 = document.getElementById("pwd1")
        , pwd2 = document.getElementById("pwd2");

    function validatePassword() {
        if (pwd1.value != pwd2.value) {
            pwd2.setCustomValidity("Passwords Don't Match");
        } else {
            pwd2.setCustomValidity('');
        }
    }

    pwd1.onchange = validatePassword;
    pwd2.onkeyup = validatePassword;
</script>
</body>
</html>
