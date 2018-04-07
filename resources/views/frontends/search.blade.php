@extends('layouts.frontend')
@section('title') Tìm kiếm: {{$tag_old}} | Tìm kiếm kho ảnh sex tuyển chọn @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_search')
    @include('frontends.includes.footer')
@endsection