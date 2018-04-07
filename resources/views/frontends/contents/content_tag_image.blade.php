<section>
    <div class="tab-content">
        <div class="m-margin-top-110px">
            <div class="container-fluid">
                <div class="m-margin-top-bottom-30px">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="clearfix mb-5 p-3 border-bottom">
                                @include('frontends.includes.menu.menu_tag')
                            </div>
                            <div class="mb-3"><p class="h3"><i class="fa fa-id-card text-info"></i> Bài viết</p></div>
                            @if(isset($images))
                                @if (count($images))
                                    <div class="grid">
                                        @foreach($images as $image)
                                            <div class="grid-item wow zoomIn">
                                                <div class="m-positon-p">
                                                    <a href="{{url($image->image_s)}}" class="m-a-p"
                                                       data-toggle="tooltip" title="{{$image->name}}">
                                                        <img class="safelyLoadImage"
                                                             src="{{in_array(substr($image->url, 0, 4), $first_url_image)?$image->url:asset($image->url_seo)}}">
                                                        <div class="m-none">
                                                            <div class="m-bg-img"></div>
                                                            <div class="m-text m-s-t">
                                                                @if($image->created_at)<h5
                                                                        class="text-dark small">{{date_format($image->created_at, "d") . ' Th' . date_format($image->created_at, "m," ). date_format($image->created_at, "Y" )}}</h5>@endif
                                                                <h2 class="text-light">{!! str_limit($image->name,$limit=7,$end='...') !!}</h2>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mb-3 mt-2 w-50 m-auto">
                                        {{Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4")}}
                                        {{ $images->links() }}
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
                            @include('frontends.includes.menu.menu_region')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--end contents-->