@extends('layouts.app')
@section('stylesheet')
    <!-- Toggle Switch -->
    <link href="{{ asset('common/toggle_switch.css') }}" rel="stylesheet">
@endsection
@section('contents')
    @include('message.message')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-sm-2">
                <a href="{{route('view.image.create')}}">
                    <button class="btn btn-info text-light"><span class="fa fa-plus"></span> Add Image</button>
                </a>

            </div>
            <div class="col-sm-10">
                <h2>All Item</h2>
                @if ($images->count() != 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#N</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Url f</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>###</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $key=>$image)
                            <tr id="{{$image->id}}">
                                <td>{{$key+1}}</td>
                                <td>{{$image->name}}</td>
                                <td>{{$image->title}}</td>
                                <td>{{str_limit($image->content,$limit=100,$end='...')}}</td>
                                <td>{{$image->url}}</td>
                                <td><img style="height: 65px" src="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url)}}"></td>
                                <td><label class="switch">
                                        <input class="status" type="checkbox"
                                               value="{{$image->status}}" {{$image->status == 1?'checked':''}}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>{!! $image->created_at?$image->created_at->todateString():'<p class="text-danger">None</p>' !!}</td>
                                <td><a href="{{url('admin/image/'.$image->id.'/edit')}}" style="margin-right: 6px"
                                       title="edit"><span
                                                class="fa fa-pencil"></span></a><a
                                            class="m-remove" href="{{url('admin/image/delete/'.$image->id)}}"
                                            title="remove" data-toggle="modal" data-target=".remove"><span
                                                class="fa fa-trash"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class=" mb-5">
                        <a href="{{route('view.image')}}" class="h3 text-dark">Not found item</a>
                    </div>
            @endif
            {{Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4")}}
            {{ $images->links() }}
            <!-- Remove -->
                <div class="modal fade remove">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delete image</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Do you want delete
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="POST" action="#" id="remove-item">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> OK
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Script jquery -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <!-- HTML -->
    <script src="{{asset('html-js/html.js')}}" type="text/javascript"></script>
    <!-- Scrip -->
    <script>
        $(document).on('click', '.m-remove', function () {
            var url = $(this).attr('href');
            $('#remove-item').attr('action', url);
        });
        closeError();
        $(document).on('click', '.status', function () {
            var current = $(this);
            $('body').append(loding());
            var token = $('meta[name="csrf-token"]').attr('content');

            var id = $(this).closest('tr').attr('id');
            var status = $(this).val();

            changeBox(current);
            $.ajax({
                url: "{{route('view.image.ajaxStatus')}}",
                dataType: 'json',
                data: {
                    '_token': token,
                    'id': id,
                    'status': status,
                },
                type: 'POST',
                success: function (response) {
                    $('#loading').remove();
                    switch (response.status) {
                        case true:
                            $('body').append($.parseHTML(successful(response.message)));
                            closeError();
                            break;
                        case false:
                            $('body').append($.parseHTML(error(response.message)));
                            if (status == 1) {
                                current.val(status);
                                current.prop('checked', true)
                            } else {
                                current.val(0);
                                current.prop('checked', false)
                            }
                            ;
                            closeError();
                            break;
                        default:
                            $('body').append($.parseHTML(error(response.message)));
                            if (status == 1) {
                                current.val(status);
                                current.prop('checked', true)
                            } else {
                                current.val(0);
                                current.prop('checked', false)
                            }
                            ;
                            closeError();
                            break;
                    }
                },
                error: function (x, e) {
                    $('#loading').remove();
                    $('body').append($.parseHTML(error('Status change fail!')));
                    if (status == 1) {
                        current.val(status);
                        current.prop('checked', true)
                    } else {
                        current.val(0);
                        current.prop('checked', false)
                    }
                    ;
                    closeError();
                }

            });
        });
    </script>
@endsection
