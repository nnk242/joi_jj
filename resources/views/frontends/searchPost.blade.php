@extends('layouts.frontend')
@section('title') Tìm kiếm: Bài viết {{$tag_old}} | Xem kho ảnh với từ khóa {{$tag_old}} @if(isset($groups)) {{$groups->currentPage() == 1?"": "| Trang " . $groups->currentPage()}} @endif @endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_search_post')
    @include('frontends.includes.footer')
@endsection