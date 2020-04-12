<div class="card mb-3 news">
    <div class="card-header bg-water-green">
        <i class="far fa-newspaper"></i>
        {{$item->title}}
    </div>
    <div class="card-body">
        @if($item->title_on_top)<h5 class="card-title">{{$item->title}}</h5>@endif
        <div class="{{$item->fixed_size?'news-content':''}}">
            {!!$item->content!!}
        </div>
        @if(!$item->title_on_top)
            <h5 class="card-title">
                <a class="btn btn-primary" href="{{route('courses.show', [$item->entity_id])}}">
                <i class="fas fa-chevron-circle-right"></i>
                </a>
                {{$item->title}}
            </h5>
        @endif
        <p class="card-text">{{$item->description}}</p>
        <p class="card-text"><small class="text-muted">{{$item->published->format('Y-m-d')}}</small></p>
    </div>
</div>
