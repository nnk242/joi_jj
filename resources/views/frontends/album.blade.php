@extends('layouts.frontend')
@section('title')@if(isset($post)){{$post->name. ' | ' . $post->type->name . ' đẹp'}} @if(isset($images)) {{$images->currentPage() != 1? ' | trang ' . $images->currentPage():''}} @endif @else @endif @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">@endsection
@section('contents')
    @include('frontends.includes.header')
    @if (isset($post))
        @include('frontends.contents.content_album')
    @else
        @include('frontends.includes.notfounds.not_file');
    @endif
        @include('frontends.includes.footer')
@endsection