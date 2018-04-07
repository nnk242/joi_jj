<section>
    <div class="tab-content">
        <div class="m-margin-top-110px">
            <div class="container-fluid">
                <div class="m-margin-top-bottom-30px">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="clearfix mb-5 p-3 border-bottom">
                                <span class="fa fa-search-plus fa-3x text-danger fa-spin"></span>
                                <i class="h2 text-success -bold">@:</i> <i class="h3 text-warning">{{$tag_old}}</i>
                            </div>
                            <div class="mb-3"><p class="h3"><i class="fa fa-id-card text-info"></i> Bài viết</p></div>
                            @if(isset($groups))
                                @if (count($groups))
                                    <div class="grid">
                                        @foreach($groups as $group)
                                            <div class="grid-item wow zoomIn">
                                                <div class="m-positon-p">
                                                    <a href="{{url($group->name_seo)}}" class="m-a-p"
                                                       data-toggle="tooltip" title="{{$group->name}}">
                                                        <img class="safelyLoadImage"
                                                             src="{{in_array(substr($group->thumbnail, 0, 4), $first_url_image)?$group->thumbnail:asset($group->thumbnail)}}">
                                                        <div class="m-none">
                                                            <div class="m-bg-img"></div>
                                                            <div class="m-text m-s-t">
                                                                <h5 class="text-dark small">{{date_format($group->created_at, "d") . ' Th' . date_format($group->created_at, "m," ). date_format($group->created_at, "Y" )}}</h5>
                                                                <h2 class="text-light">{{$group->name}}</h2>
                                                                <p class="text-danger"><i
                                                                            class="fa fa-eye"></i> {{post_views($group->view)}}
                                                                    -
                                                                    <i class="fa fa-picture-o"></i> {{count($group->image)}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($count_group > $tag_num)
                                        <div class="text-center mb-3 mt-2">
                                            <a href="{{route('searchPost', ['id' => $tag_old])}}"
                                               data-toggle="tooltip" title="Xem thêm">
                                                <button class="btn btn-secondary"><i
                                                            class="fa fa-plus-square-o"></i>
                                                    Xem thêm
                                                </button>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    @include('frontends.includes.notfounds.not_item')
                                @endif
                            @else
                                @include('frontends.includes.notfounds.back_home')
                            @endif
                            <hr/>
                            <div class="mb-3"><p class="h3"><i class="fa fa-picture-o text-info"></i> Hình ảnh</p></div>
                            @if(isset($images))
                                @if (count($images))
                                    <div class="grid">
                                        @foreach($images as $key=>$image)
                                            <div class="grid-item wow zoomIn">
                                                <div class="m-positon-p">
                                                    <a href="{{route('image', ['id', $tag_old])}}" class="m-a-p"
                                                       data-toggle="tooltip" title="{{$image->name}}">
                                                        <img class="safelyLoadImage"
                                                             src="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url)}}">
                                                        <div class="m-none">
                                                            <div class="m-bg-img"></div>
                                                            <div class="m-text m-s-t">
                                                                <h5 class="text-dark small">{{date_format($image->created_at, "d") . ' Th' . date_format($image->created_at, "m," ). date_format($group->created_at, "Y" )}}</h5>
                                                                <h2 class="text-light">{!! str_limit($group->name,$limit=7,$end='...') !!}</h2>
                                                                <p class="text-danger"><i
                                                                            class="fa fa-eye"></i> {{post_views($image->view)}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(isset($count_s_img))
                                        @if ($count_s_img > $key+1)
                                            <div class="text-center mb-3">
                                                <a href="{{route('searchImage', ['id' => $tag_old])}}"
                                                   data-toggle="tooltip" title="Xem thêm">
                                                    <button class="btn btn-secondary"><i
                                                                class="fa fa-plus-square-o"></i>
                                                        Xem thêm
                                                    </button>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @include('frontends.includes.notfounds.not_item')
                                @endif
                            @else
                                @include('frontends.includes.notfounds.back_home')
                            @endif
                        </div>
                        <div class="col-md-3">
                            @include('frontends.includes.menu.menu_type')
                            @include('frontends.includes.menu.menu_tag')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--end contents-->