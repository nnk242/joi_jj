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
                <a title="Back to image" class="h2" href="{{url('admin/image')}}"><span
                            class="fa fa-arrow-left text-warning"></span></a>
            </div>
            <div class="col-md-9">
                <div>
                    <div class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="file" id="photo" class="form-control-file m-photo" name="u_upload_file_m[]" accept="image/*"/>
                        </div>
                        <button type="button" id="upload" class="btn btn-info mx-sm-3 mb-2"><span
                                    class="fa fa-cloud-upload"></span>&nbsp;Upload to flickr
                        </button>
                        <button type="button" id="upload-serve" class="btn btn-warning mx-sm-3 mb-2"><span
                                    class="fa fa-braille"></span>&nbsp;Upload to serve
                        </button>
                        <img id="output"/>
                    </div>
                </div>
                <form method="POST" action="{{route('view.image.uploadfile')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-inline mb-1">
                        <div class="form-group col-sm-2">
                            <label for="p-name" class="col-form-label">Name</label>
                        </div>
                        <div class="form-group col-sm-3">
                            <input class="form-control" id="p-name" name="p_name" placeholder="All name">
                        </div>
                        <div class="form-check mx-sm-3 mb-2">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="name-check" name="name_check">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-inline mb-1">
                        <div class="form-group col-sm-2">
                            <label for="p-title" class="col-form-label">Title</label>
                        </div>
                        <div class="form-group col-sm-3">
                            <input class="form-control" id="p-title" name="p_title" placeholder="All title">
                        </div>
                        <div class="form-check mx-sm-3 mb-2">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="title-check" name="title_check">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group col-sm-2">
                            <label for="p-content" class="col-form-label">Content</label>
                        </div>
                        <div class="form-group col-sm-3">
                            <textarea class="form-control" id="p-content" name="p_content" placeholder="All content"></textarea>
                        </div>
                        <div class="form-check mx-sm-3 mb-2">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="content-check" name="content_check">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-inline mt-1">
                        <div class="form-group col-sm-2">
                            <label for="group" class="col-form-label">Choose only group</label>
                        </div>
                        <div class="form-group col-sm-3">
                            <select class="form-control group" id="group" name="group">
                                <option value="">---None---</option>
                            </select>
                        </div>
                        <div class="form-check mx-sm-3 mb-2">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="group-check" name="group_check">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-inline mt-1">
                        <div class="form-group col-sm-2">
                            <label for="p-status" class="col-form-label">Show or hide || All item</label>
                        </div>
                        <div class="form-check col-sm-3">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="p-status" name="p_status" value="1" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="form-check mx-sm-3">
                            <label class="switch">
                                <input type="checkbox" class="form-check-input" id="status-check" name="status_check">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <hr/>
                    <ul id="file-uploaded" class="m-list-style-type-none"></ul>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Script jquery -->
    <script src="{{asset('jquery/jquery.js')}}" type="text/javascript"></script>
    <!-- Script upload-js photo -->
    <script src="{{asset('html-js/html.js')}}" type="text/javascript"></script>
    <script src="{{asset('upload-js/upload-photo.js')}}" type="text/javascript"></script>
    <script>
        //Tạo một đối tượng uploadPhoto
        var UploadPhoto = new uploadPhoto('{!! route('view.image.store') !!}');
        //Thực hiện hàm init để cài đặt token cho ajax và bắt sự kiện upload-js
        UploadPhoto.init();

        $(document).on('click', '.u-upload-file-serve', function () {
            uploadServe('{!! route('view.image.uploadServe') !!}',
                $(this).closest('.upload-a-file').find('.u-name').val(),
                $(this).closest('.upload-a-file').find('.u-title').val(),
                $(this).closest('.upload-a-file').find('.u-contents').val(),
                $(this).closest('.upload-a-file').find('.u-group').val(),
                $(this).closest('.upload-a-file').find('.u-status').val(),
                $(this).closest('.upload-a-file').find('.m-photo').prop('files')[0],
                $(this)
            )
        });

        $(document).on('click', '#upload-serve', function () {
            try {
                validateFile($(this), this);
                var src = URL.createObjectURL($('#photo').prop('files')[0]);
                var group_, name_, content_, title_;
                $('#group-check').val() == 1 ? group_ = '' : group_ = 'required';
                $('#name-check').val() == 1 ? name_ = '' : name_ = 'required';
                $('#title-check').val() == 1 ? title_ = '' : title_ = 'required';
                $('#contents-check').val() == 1 ? content_ = '' : content_ = 'required';
                $('#file-uploaded').append(item_pic(group_, name_, title_, content_, src, '', 1));
                if ($('#file-uploaded').find('li').length === 1) {
                    $('#file-uploaded').after('<div style="clear:left;" class="text-center mt-2 mb-2 u-buttom-upload">' +
                        '<button type="submit" class="btn btn-success">Submit</button></div>');
                }
                var $this = $('#photo'), $clone = $this.clone();
                $('.upload-a-file').last().append($clone);
                $('.m-photo').last().addClass( "m-none" )
            } catch (Ex) {
                validateFile($(this));
            }
        });

        closeError();
    </script>
@endsection
