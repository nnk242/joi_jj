@extends('layouts.app')
@section('stylesheet')
    <!-- Toggle Switch -->
    <link href="{{ asset('common/toggle_switch.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.bootstrap3.css"/>


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
                @if($group)
                    <form id="{{$group->id}}" method="post" action="" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="m-height-250px mt-2"><img id="image" class="card-img-top m-img-b"
                                                              src="{{in_array(substr($group->thumbnail, 0, 4), $first_url_image)?$group->thumbnail:asset($group->thumbnail)}}"
                                                              alt="Card image cap">
                        </div>
                        <div class="form-group">
                            <label for="upload_image">Upload image thumbnail:</label>
                            <input type="file" class="form-control" id="upload_image" name="image_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="url">link image thumbnail</label>
                            <input type="text" class="form-control" id="url" value=""
                                   placeholder="Enter image" name="link_image_thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="{{$group->name}}"
                                   placeholder="Enter name" name="name" required>
                        </div>
                            <div class="form-group">
                                <label for="name_seo">Name seo:</label>
                                <input type="text" class="form-control" id="name_seo" value="{{$group->name_seo}}"
                                       placeholder="Enter name seo" name="name_seo" readonly>
                            </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" placeholder="Enter description"
                                      name="description">{{$group->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="region"
                                    required>
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}" {{$region->id == $group->region_id?'selected':''}}>{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="custom-select my-1 mr-sm-2" id="type" name="type"
                                    required>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" {{$type->id == $group->type_id?'selected':''}}>{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <label class="switch">
                                <input type="checkbox" {{$group->status == 1?'checked':''}} name="status" value="{{$group->status}}" id="status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="input-tags3">Input tag:</label>
                            <input class="form-control create_tag" name="tag" value="{{$group->tag}}" style="width: 100% !important;">
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
@section('js')
    <!-- Script jquery -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('html-js/html.js')}}" type="text/javascript"></script>
    <script src="https://selectize.github.io/selectize.js/js/selectize.js"></script>

    <script>
        $(document).ready(function () {
            var timeout = null;
//name

            $('#name').on('focus', function () {
                $('#update').prop('disabled', true);
            });
            $('#name').on('blur', function () {
                $('#update').prop('disabled', false);
            });

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
                        url: '{{ route('view.group.getNameSeoGroup') }}',
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

        $('.create_tag').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

    </script>
@endsection
