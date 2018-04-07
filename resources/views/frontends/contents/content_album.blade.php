<section>
    <nav class="m-margin-top-57px fixed-top bg-light" id="m-nav-tab">
        <nav class="breadcrumb">
            <div class="container">
                <a class="breadcrumb-item" href="{{url('/')}}" data-toggle="tooltip" data-placement="bottom"
                   title="Trang chủ"><i class="fa fa-home"></i>Trang chủ</a>
                <a class="breadcrumb-item"
                   href="{{route('region', ['id'=>$continent->name_seo])}}" data-toggle="tooltip"
                   data-placement="bottom" title="{{$continent->name}}">{{$continent->name}}</a>
                <a class="breadcrumb-item"
                   href="{{route('region', ['id'=>$post->region->name_seo])}}" data-toggle="tooltip"
                   data-placement="bottom" title="{{$post->region->name}}">{{$post->region->name}}</a>
                <a class="breadcrumb-item"
                   href="{{route('region', ['id'=>$post->type->name_seo])}}" data-toggle="tooltip"
                   data-placement="bottom" title="{{$post->type->name}}">{{$post->type->name}}</a>
                <span class="breadcrumb-item active" data-toggle="tooltip" data-placement="bottom"
                      title="{{$post->name}}">{{$post->name}}</span>
            </div>
        </nav>
    </nav>
    <main>
        <div class="tab-content mt-5" id="nav-tabContent">
            <div class="tab-pane fade m-margin-top-150px show active" id="nav-profile" role="tabpanel"
                 aria-labelledby="nav-profile-tab">
                <div class="container-fluid">
                    <div class="m-margin-top-bottom-30px">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-9">
                                    <div>
                                        @if (isset($post->created_at))
                                            <p class="text-secondary small"><i class="fa fa-calendar"></i> Ngày
                                                đăng: {{dayofweed(date_format($post->created_at, "w"))}},
                                                {{date_format($post->created_at, "d/m/Y | ")}} <i
                                                        class="fa fa-clock-o"></i>
                                                {{date_format($post->created_at, 'H:i')}}
                                            </p>
                                        @endif
                                    </div>
                                    <div>
                                        <h1 data-toggle="tooltip" title="{{$post->name}}">{{$post->name}}</h1>
                                        <p class="-bold"><i class="fa fa-eye"></i> {{$post->view}}</p>
                                        <h4>{{$post->description}}</h4>
                                    </div>
                                    @if(count($images)>0)
                                        <div>
                                            @foreach($images as $image)
                                                <p class="">{{$image->content}}</p>
                                                <a href="{{route('image', ['id' => $image->image_s])}}" data-toggle="tooltip"
                                                   title="{{$image->name}}"><img
                                                            class="m-img-w m-border-darius-5 safelyLoadImage"
                                                            src="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url_seo )}}">
                                                    <p class="text-info text-center">{{$image->title . date_format($image->created_at, " - d/m/Y")}}</p>
                                                </a>
                                            @endforeach
                                            <div class="mb-3 mt-2 w-50 m-auto">
                                                {{Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4")}}
                                                {{ $images->links() }}
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <hr/>
                                        </div>
                                        @include('frontends.includes.menu.menu_tag')
                                    @else
                                        @include('frontends.includes.notfounds.not_item')
                                    @endif

                                </div>

                                <div class="col-md-3">
                                    @include('frontends.includes.menu.menu_type')
                                    @include('frontends.includes.menu.menu_relationship')
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</section>
<!--end contents-->