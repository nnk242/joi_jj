@extends('layouts.frontend')
@section('title') Tổng hợp ảnh sex {{ $groups->currentPage() == 1 ? '' : ' | Trang ' . $groups->currentPage() }} @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_post_view')
    @include('frontends.includes.footer')
@endsection