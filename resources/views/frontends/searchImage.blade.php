@extends('layouts.frontend')
@section('title') Tìm kiếm: Ảnh {{$tag_old}} | Xem kho ảnh với từ khóa {{$tag_old}} @if(isset($images)) {{$images->currentPage() == 1?"": "| Trang " . $images->currentPage()}} @endif @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_search_image')
    @include('frontends.includes.footer')
@endsection