@extends('layouts.frontend')
@section('title') Kho ảnh {{isset($type_id)?$type_id->name:'sex'}} chọn lọc cập nhật mỗi ngày {{isset($groups)? $groups->currentPage() == 1 ? '' : ' | trang ' . $groups->currentPage() : ''}} @endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('common/header.css')}}">
@endsection
@section('contents')
    @include('frontends.includes.header')
    @include('frontends.contents.content_type')
    @include('frontends.includes.footer')
@endsection
