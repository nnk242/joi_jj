<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- icon page -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}" />
    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <!-- Animate styles -->
    <link href="{{ asset('animate/animate.min.css') }}" rel="stylesheet">
    <!-- Common styles -->
    <link href="{{ asset('common/style.min.css') }}" rel="stylesheet">
    <!-- Font awesome styles -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('selectize/css/bootstrap3.min.css') }}" rel="stylesheet">
    @yield('stylesheet')
    {{ __DIR__ }}
</head>
<body>
<div id="app">

    <div id="loading" class="bg-dark">
        <div id="loading-image">
            <img src="{{asset('loading.svg')}}" width="200px">
            <p class="h1 text-light">Loading...</p>
        </div>
    </div>
    @yield('contents')
</div>
<script src="{{asset('jquery/jquery.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- common header -->
<script src="{{ asset('common/js/header.min.js') }}"></script>
{{--masonry--}}
<script src="{{ asset('masonry/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('masonry/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- animate js -->
<script src="{{ asset('animate/wow.min.js') }}"></script>
<!--  selectize -->
<script src="{{ asset('selectize/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('selectize/selectize.min.js') }}"></script>
<!-- commmon js -->
<script src="{{ asset('common/js/common.min.js') }}"></script>
@yield('js')
</body>
</html>