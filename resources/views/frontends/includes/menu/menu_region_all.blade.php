<div class="mb-2 mt-5">
    <div class="p-1">
        <p class="h4 ml-1 text-muted"><i class="fa fa-flag"></i> Quốc gia</p>
    </div>
    <h2 class="h5">
        @if(!isset($regions))
            @foreach($regions as $region)
                <a href="{{route('region', ['id'=>$region->name_seo])}}" class="text-dark" data-toggle="tooltip" title="{{$region->name}}">
                    <div class="float-left p-1 border-secondary border mr-1 ml-1 mt-1 mb-1 m-tag">
                        <div style="width: 20px" class="float-left"><img class="m-img-w" src="{{in_array(substr($region->image, 0, 4), $first_url_image)?$region->image:asset($region->image)}}"></div> {{$region->name}}
                    </div>
                </a>
            @endforeach
        @else
            @foreach($regions as $region)
                @if($region->name_seo != $region_old)
                    <a href="{{route('region', ['id'=>$region->name_seo])}}" class="text-dark" data-toggle="tooltip" title="{{$region->name}}">
                        <div class="float-left p-1 border-secondary border mr-1 ml-1 mt-1 mb-1 m-tag">
                            <div style="width: 20px" class="float-left"><img class="m-img-w" src="{{in_array(substr($region->image, 0, 4), $first_url_image)?$region->image:asset($region->image)}}"></div> {{$region->name}}
                        </div>
                    </a>
                @endif
            @endforeach
        @endif
    </h2>
</div>
