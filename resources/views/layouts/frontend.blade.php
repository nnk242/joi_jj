<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Animate styles -->
    <link href="{{ asset('animate/animate.css') }}" rel="stylesheet">
    <!-- Common styles -->
    <link href="{{ asset('common/style.css') }}" rel="stylesheet">
    <!-- Font awesome styles -->
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('selectize/css/bootstrap3.css') }}" rel="stylesheet">
    @yield('stylesheet')
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
<script src="{{asset('jquery/jquery.js')}}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('common/js/header.js') }}"></script>
{{--masonry--}}
<script src="{{ asset('masonry/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('masonry/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- animate js -->
<script src="{{ asset('animate/wow.js') }}"></script>
<!--  selectize -->
<script src="{{ asset('selectize/standalone/selectize.js') }}"></script>
<script src="{{ asset('selectize/selectize.js') }}"></script>
<script type="text/javascript">
    $(function(){
        //not found image
        var notFoundImage = window.location.origin + "/uploads/default/default.jpg";
        var realImageSrc = $(".safelyLoadImage").data("imgsrc");
        $(".safelyLoadImage").attr("onerror", "this.onerror=null; this.src='" + notFoundImage + "';");
        $(".safelyLoadImage").attr("src", realImageSrc);
        $(".safelyLoadImage").removeClass("safelyLoadImage");
        //
        //title image
        $('[data-toggle="tooltip"]').tooltip();
        //
    });

    window.onload = function () {
        $('#loading').fadeOut();
    }

    var $grid_ = $('.grid').masonry({
        // options...
        itemSelector: '.grid-item'
    });

    $grid_.imagesLoaded().progress( function() {
        $grid_.masonry('layout');
    });

    var $grid = $('.grid_c').imagesLoaded( function() {
        // init Masonry after all images have loaded
        $grid.masonry({
            // options...
            itemSelector: '.grid-item-c',
        });
    });

    new WOW().init();
    $('#select-repo').selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name'],
        create: true,
        maxItems: 1,
        maxOptions: 10,
        render: {
            option: function (item, escape) {
                return '<div>' +
                    '<span class="title">' +
                    '<span class="name"><a href="11232">' + escape(item.name) + '</a></span>' +
                    '<span style="float: right;" class="name">' + escape(item.view) + '</span>' +
                    '</span>' +
                    '</div>';
            }
        },
        load: function (query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: '/tim-kiem/' + encodeURIComponent(query),
                type: 'GET',
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res);
                }
            });
        },
    });

</script>
@yield('js')
</body>
</html>