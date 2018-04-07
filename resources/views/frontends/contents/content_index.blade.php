<section>
    <div class="tab-content mt-5">
        <div class="m-margin-top-150px" id="nav-home" role="tabpanel"
             aria-labelledby="nav-home-tab">
            <div class="container-fluid">
                <div class="m-margin-top-bottom-30px">
                    <div class="row">
                        <div class="col-md-9">
                            @if(count($groups) > 0)
                                <div class="grid">
                                    <div class="grid-item wow zoomIn">
                                        <div class="m-positon-p">
                                            <a href="{{url($update->name_seo)}}" class="m-a-p" data-toggle="tooltip"
                                               title="{{$update->name}}">
                                                <img class="safelyLoadImage"
                                                     src="{{ isset($update->image[0]) ? in_array(substr(($update->image[0])->url, 0, 4), $first_url_image)?($update->image[0])->url:asset(($update->image[0])->url) : '/'}}">
                                                <div class="m-none">
                                                    <div class="m-bg-img"></div>
                                                    <div class="m-text m-s-t">
                                                        @if(isset(($update->image[0])->updated_at))<h5
                                                                class="text-dark small">{{date_format(($update->image[0])->updated_at, "d") . ' Th' . date_format(($update->image[0])->updated_at, "m," ). date_format(($update->image[0])->updated_at, "Y" )}}</h5>@endif
                                                        <h2 class="text-light h3">{!! str_limit($update->name,$limit=7,$end='...') !!}</h2>
                                                        <p class="text-danger"><i
                                                                    class="fa fa-eye"></i> {{post_views($update->view)}}
                                                            -
                                                            <i class="fa fa-picture-o"></i> {{count($update->image)}}
                                                        </p>
                                                        @if(isset($count_img))<p
                                                                class="text-success"><i
                                                                    class="fa fa-file-image-o"></i> {{$count_img}}
                                                            ảnh mới</p>@endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @foreach($groups as $key=>$group)
                                        <div class="grid-item wow zoomIn">
                                            <div class="m-positon-p">
                                                <a href="{{url($group->name_seo)}}" class="m-a-p" data-toggle="tooltip"
                                                   title="{{$group->name}}">
                                                    <img class="safelyLoadImage"
                                                         src="{{in_array(substr($group->thumbnail, 0, 4), $first_url_image)?$group->thumbnail:asset($group->thumbnail)}}">
                                                    <div class="m-none">
                                                        <div class="m-bg-img"></div>
                                                        <div class="m-text m-s-t">
                                                            @if(isset($group->created_at))<h5
                                                                    class="text-dark small">{{date_format($group->created_at, "d") . ' Th' . date_format($group->created_at, "m," ). date_format($group->created_at, "Y" )}}</h5>@endif
                                                            <h2 class="text-light">{!! str_limit($group->name,$limit=7,$end='...') !!}</h2>
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
                                @if($key == $show_img-1)
                                    <div class="text-center mb-3">
                                        <a href="{{route('postView')}}" data-toggle="tooltip" title="Xem thêm">
                                            <button class="btn btn-secondary"><span class="fa fa-plus"></span> Xem thêm
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            @else
                                @include('frontends.includes.notfounds.not_item')
                            @endif
                        </div>
                        <div class="col-md-3">
                            @include('frontends.includes.menu.menu_type')
                            @include('frontends.includes.menu.menu_region')
                            @include('frontends.includes.menu.menu_top_view')
                            @include('frontends.includes.menu.menu_tag')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--end contents-->