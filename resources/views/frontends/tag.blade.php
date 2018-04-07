@extends('layouts.frontend')
@section('title') Tag: {{$tag_old}} | Kho ảnh sex với tag {{$tag_old}} @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_tag')
    @include('frontends.includes.footer')
@endsection