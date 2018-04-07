<section>
    <nav class="m-margin-top-57px fixed-top bg-light" id="m-nav-tab">
        <nav class="breadcrumb">
            <div class="container">
                <h1 class="breadcrumb-item active h5 text-center">
                    @if(isset($region_id))<a href="{{route('region', ['id'=>$region_id->name_seo])}}"
                                             data-toggle="tooltip" title="{{$region_id->name}}"><i
                                class="fa fa-spin fa-fw"><img class="safelyLoadImage" style="width: 20px"
                                                              src="{{in_array(substr($region_id->image, 0, 4), $first_url_image)?$region_id->image:asset($region_id->image)}}"></i>
                        <span class="sr-only">Loading...</span>{{$region_id->name}}</a>
                    @else
                        <span><i class="fa fa-cog fa-spin fa-fw text-warning"></i>
                            <i class="sr-only">Loading...</i>Quốc gia không tồn tại
                        </span>
                    @endif
                </h1>
            </div>
        </nav>
    </nav>
    <main>
        <div class="tab-content mt-5">
            <div class="tab-pane fade show active m-margin-top-110px">
                <div class="container-fluid">
                    <div class="m-margin-top-bottom-30px">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="clearfix mb-5 p-3 border-bottom">
                                    @include('frontends.includes.menu.menu_region_all')
                                </div>
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
                                        <div class="text-center mb-3">
                                            {{ $groups->links() }}
                                        </div>
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
    </main>
</section>
<!--end contents-->