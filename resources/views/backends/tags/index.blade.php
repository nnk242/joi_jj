@extends('layouts.app')
@section('stylesheet')
    {{--<link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.default.css" />--}}
    {{--<link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.bootstrap2.css" />--}}
    <link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.bootstrap3.css"/>
    {{--<link rel="stylesheet" href="https://selectize.github.io/selectize.js/css/selectize.legacy.css" />--}}
@endsection
@section('contents')
    @include('message.message')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-sm-4">
                <h1>Add tags</h1>
                <form method="POST" action="{{route('view.tag.create')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="input-tags3">Input tag:</label>
                        <input class="form-control create_tag" id="input-tags3" name="create_tag">
                    </div>
                    <button class="btn btn-success">submit</button>
                </form>
            </div>
            <div class="col-sm-8">
                <div class="mb-3">
                    <h3>TAG page</h3>
                </div>
                @if (isset($tag))
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name tag</th>
                            <th>SEO</th>
                            <th>Date</th>
                            <th>###</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="{{$tag->id}}">
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->name_seo}}</td>
                            <td>{!! $tag->created_at?$tag->created_at->todateString():'<p class="text-danger">None</p>' !!}</td>
                            <td><a href="{{url('admin/group/'.$tag->id.'/edit')}}" style="margin-right: 6px"
                                   title="edit" data-toggle="modal" data-target="#edit"><span
                                            class="fa fa-pencil"></span></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    <div class=" mb-5">
                        <a href="{{route('view.group')}}" class="h3 text-dark">Not found item</a>
                    </div>
            @endif
            {{--{{Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4")}}--}}
            {{--{{ $groups->links() }}--}}

            <!--delete-->
                <div class="modal fade" id="edit">
                    <div class="modal-dialog">
                        <form method="POST" action="#" id="remove-item">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Tag</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="input-tags3">Input tag:</label>
                                        <input class="form-control create_tag" name="edit_tag" value="{{$tag->name}}">
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> OK
                                    </button>
                                    <button type="reset" class="btn btn-warning"><span class="fa fa-check"></span> Reset
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
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
    <script src="https://selectize.github.io/selectize.js/js/selectize.js"></script>
    <script>
        closeError();
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
