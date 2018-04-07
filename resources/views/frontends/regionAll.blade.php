@extends('layouts.frontend')
@section('title')Xem ảnh @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_region_all')
    @include('frontends.includes.footer')
@endsection