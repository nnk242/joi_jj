@extends('layouts.frontend')
@section('title') Tag: {{$tag_old}} | Bài viết ảnh sex với tag {{$tag_old}} @if(isset($groups)) {{$groups->currentPage() == 1 ? '':' | Trang '.$groups->currentPage()}} @endif @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_tag_post')
    @include('frontends.includes.footer')
@endsection