@extends('layouts.frontend')
@section('title') Tag: {{$tag_old}} | Kho ảnh sex với tag {{$tag_old}} @if(isset($images)) {{$images->currentPage() == 1 ? '':' | Trang '.$images->currentPage()}} @endif @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_tag_image')
    @include('frontends.includes.footer')
@endsection
