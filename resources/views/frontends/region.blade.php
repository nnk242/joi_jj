@extends('layouts.frontend')
@section('title') @if(isset($region_id)) {{$region_id->name}} @else Quốc gia không tồn tại @endif  | Ảnh sex chọn lọc @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_region')
    @include('frontends.includes.footer')
@endsection