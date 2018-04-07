<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="m-margin-top-bottom-15px">
                <p class="h4 text-dark"><span class="fa fa-object-group text-white"></span>&nbsp;Bài
                    viết xem nhiều...</p>
            </div>
        </div>
    @if(isset($views))
        @if(count($views))
            @foreach($views as $key=>$view)
                <!--col-md-2-->
                    <div class="col-md-2">
                        <div class="card">
                            <a href="{{route('post', ['id'=>$view->group->name_seo])}}" title="#1">
                                <div class="card-header text-center"><span
                                            class="h2 text-danger">{{$key+1}}</span>
                                </div>
                                <div class="card-block">
                                    <div class="card-title text-center"><p class="h5 text-dark">{{$view->group->name}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="mt-3 mb-5">
                        <div class="text-center">
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw text-warning"></i>
                            <span class="sr-only">Loading...</span>
                            <p class="text-light h3">Đang cập nhật...</p>
                        </div>
                    </div>
                </div>

            @endif
        @endif
    </div>
    <hr>
</div>