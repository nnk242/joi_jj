<div class="mb-2 mt-5">
    <div class="p-1">
        <p class="h4 ml-1 text-muted"><i class="fa fa-map-o"></i> Bài viết gần nhất</p>
    </div>
    @foreach($post_relationship as $val)
        <h2 class="h5">
            <a href="{{route('post', ['id'=>$val->name_seo])}}" class="text-dark" data-toggle="tooltip" title="{{$val->name}}">
                <div class="ml-1 border-bottom border-secondary p-1 m-menu-type">
                    <div class="m-type-a">
                        <i class="fa fa-address-card-o text-info"></i> {{$val->name}}
                    </div>

                </div>
            </a>
        </h2>
    @endforeach
</div>