@extends('layouts.frontend')
@section('title')Xem ảnh - {{isset($image)?$image->name:"Hình ảnh không tồn tại"}}@endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">@endsection
@section('contents')
    @include('frontends.includes.header')
    <div class="m-margin-top-110px">
        <div class="mb-5">
            <div class="container-fluid">
                <div>
                    @if(isset($image))
                        <div class="mb-5"><p class="text-warning text-center"><span
                                        class="fa fa-eye"></span> {{$image->view}} Lượt xem - <span
                                        class="text-dark small">{{date_format($image->updated_at, "d") . ' Th' . date_format($image->updated_at, "m," ). date_format($image->updated_at, "Y" )}}</span>
                            </p><a href="{{route('post', ['id'=>$group->name_seo])}}" data-toggle="tooltip"
                                   title="{{$group->name}}"><h1
                                        class="h3 text-danger text-uppercase text-center">{{$image->name}}</h1></a>
                        </div>
                        <img src="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url)}}"
                             class="m-collection-w m-border-darius-5 m-border-img" id="m-img">
                        @if (!in_array(substr($image->url, 0, 4), $first_url_image))
                            <div class="m-tab m-opacity-7">
                                <a href="#tab"><img class="m-img-w" src="{{asset("common/image/plus.png")}}"></a>
                                <div class="m-tab-icon">
                                    <div class="m-tab-c">
                                        <div>
                                            <a download="{{$image->name}}.jpg"
                                               href="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url)}}">
                                                <img class="m-img-w" src="{{asset("common/image/download.png")}}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="m-bg"></div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center">
                            <a href="/">
                                <p class="h1 text-dark">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-file-image-o fa-stack-1x"></i>
                                <i class="fa fa-ban fa-stack-2x text-danger"></i>
                                </span>Hình ảnh không tồn tại</p>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="backgroup"></div>
@endsection
@section('js')
    <script>
        var bg = $("#m-img").attr("src");
        $('#backgroup').css({"background-image": 'url("' + bg + '")'});
    </script>
@endsection