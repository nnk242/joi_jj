@extends('layouts.app')
@section('stylesheet')
    <!-- Toggle Switch -->
    <link href="{{ asset('common/toggle_switch.css') }}" rel="stylesheet">
@endsection
@section('contents')
    @include('message.message')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3">
                <a title="Back to group" class="h2" href="{{url('admin/group')}}"><span
                            class="fa fa-arrow-left text-warning"></span></a>
                <hr>
            </div>
            <div class="col-md-9">
                @if($region)
                    <form id="{{$region->id}}" method="post" action="" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="m-height-250px mt-2"><img id="image" class="card-img-top m-img-b"
                                                              src="{{in_array(substr($region->image, 0, 4), $first_url_image)?$region->image:asset($region->image)}}"
                                                              alt="Card image cap">
                        </div>
                        <div class="form-group">
                            <label for="upload_image">Upload flag image:</label>
                            <input type="file" class="form-control" id="upload_image" name="flag_image">
                        </div>
                        <div class="form-group">
                            <label for="url">Image link</label>
                            <input type="text" class="form-control" id="url" value=""
                                   placeholder="Enter image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{$region->name}}"
                                   placeholder="Enter name" name="name" required>
                        </div>
                            <div class="form-group">
                                <label for="name_seo">Name seo:</label>
                                <input type="text" class="form-control" id="name_seo" value="{{$region->name_seo}}"
                                       placeholder="Enter name seo" name="name_seo" readonly>
                            </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" placeholder="Enter description"
                                      name="description" required>{{$region->description}}</textarea>
                        </div>
                        <div class="form-group text-center">
                            <label class="switch">
                                <input type="checkbox" {{$region->status == 1?'checked':''}} name="status" value="{{$region->status}}" id="status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a href="{{url('admin/group')}}"><button type="button" class="btn btn-danger">Back</button></a>
                        </div>
                    </form>
                @else
                    <h3>Item not found....</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('standalone')
    <!-- Script jquery -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('html-js/html.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var timeout = null;
//name
            $('#name').on('keyup', function () {
                var current = $(this);
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $('body').append(loding());
                    current.attr('disabled', true);
                    var token = $('meta[name="csrf-token"]').attr('content');
                    var name = current.val();
                    var id = current.closest('form').attr('id');
                    console.log(id, name);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('view.group.getNameSeoRegion') }}',
                        data: {
                            "_token": token,
                            'name': name,
                            'id': id
                        },
                        dataType: 'JSON',
                        timeout: 1000,
                        success: function (response) {
                            $('#loading').remove();
                            current.attr('disabled', false);
                            switch (response.status) {
                                case true:
                                    $('body').append($.parseHTML(successful(response.message)));
                                    $('#name_seo').val(response.value_seo);
                                    break;
                                case false:
                                    $('body').append($.parseHTML(error(response.message)));
                                    break;
                                default:
                                    $('body').append($.parseHTML(error(response.message)));
                                    break;
                            }
                            closeError();
                        },
                        error: function () {
                            $('#loading').remove();
                            current.attr('disabled', false);
                            $('body').append($.parseHTML(error("Error!!!")));
                        }
                    })
                }, 800);
                closeError();
                current.attr('disabled', false);
            });
        });
        closeError();
        changeBox('#status');
    </script>
@endsection
