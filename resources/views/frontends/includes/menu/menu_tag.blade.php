@if (isset($tags))
    <div class="mb-2 mt-5">
        <div class="p-1">
            <p class="h4 ml-1 text-muted"><i class="fa fa-tags"></i> TAGS</p>
        </div>
        <h2 class="h5">
            @if(!isset($tag_old))
                @for($i = 0;$i<count($tags['name']); $i++)
                    <a href="{{route('tag', ['id'=>$tags['name_seo'][$i]])}}" class="text-dark" data-toggle="tooltip" title="{{$tags['name'][$i]}}">
                        <div class="float-left p-1 border-secondary border mr-1 ml-1 mt-1 mb-1 m-tag">
                            <i class="fa fa-hashtag text-warning"></i> {{$tags['name'][$i]}}
                        </div>
                    </a>
                @endfor
            @else
                @for($i = 0;$i<count($tags['name']); $i++)
                    @if($tags['name_seo'][$i] != $tag_old)
                        <a href="{{route('tag', ['id'=>$tags['name_seo'][$i]])}}" class="text-dark" data-toggle="tooltip" title="{{$tags['name'][$i]}}">
                            <div class="float-left p-1 border-secondary border mr-1 ml-1 mt-1 mb-1 m-tag">
                                <i class="fa fa-hashtag text-warning"></i> {{$tags['name'][$i]}}
                            </div>
                        </a>
                    @endif
                @endfor
            @endif
        </h2>
    </div>
@endif