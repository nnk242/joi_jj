<div class="mb-2">
    <div class="p-1">
        <p class="h4 ml-1 text-muted"><i class="fa fa-sliders"></i> Danh mục</p>
    </div>
    @if(count($types))
        @foreach($types as $type)
            <h2 class="h5">
                @if(!isset($type_id))
                    <a href="{{route('type', ['id'=>$type->name_seo])}}" class="text-dark" data-toggle="tooltip"
                       title="{{$type->name}}">
                        <div class="ml-1 border-bottom border-secondary p-1 m-menu-type">
                            <div class="m-type-a">
                                <i class="fa fa-file-photo-o text-info"></i> {{$type->name}}
                            </div>

                        </div>
                    </a>
                @else
                    @if($type->id == $type_id->id)
                        <span class="text-warning" data-toggle="tooltip" title="{{$type->name}}">
                        <div class="ml-1 border-bottom border-secondary p-1 m-menu-type">
                            <div class="m-type-a">
                                <i class="fa fa-file-photo-o text-info"></i> {{$type->name}}
                            </div>
                        </div>
                    </span>
                    @else
                        <a href="{{route('type', ['id'=>$type->name_seo])}}" class="text-dark" data-toggle="tooltip"
                           title="{{$type->name}}">
                            <div class="ml-1 border-bottom border-secondary p-1 m-menu-type">
                                <div class="m-type-a">
                                    <i class="fa fa-file-photo-o text-info"></i> {{$type->name}}
                                </div>

                            </div>
                        </a>
                    @endif
                @endif
            </h2>
        @endforeach
    @else
        <div class="mt-3 mb-5">
            <div class="text-center">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw text-warning"></i>
                <span class="sr-only">Loading...</span>
                <p class="text-secondary h3">Đang cập nhật...</p>
            </div>
        </div>
    @endif
</div>