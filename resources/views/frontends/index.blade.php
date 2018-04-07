@extends('layouts.frontend')
@section('title') Trang chủ | Anhxxx.net - Ảnh sex bướm xinh @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_index')
    @include('frontends.includes.footer_index')
@endsection