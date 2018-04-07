@extends('layouts.frontend')
@section('title') Góp ý | Ảnh sex @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_faq')
    @include('frontends.includes.footer_faq')
@endsection