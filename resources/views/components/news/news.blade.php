<div class="card mb-3 news">
    <div class="card-header bg-news">
        <i class="far fa-newspaper"></i>
        {{$item->title}}
    </div>
    <div class="card-body">
        @if($item->title_on_top)<h5 class="card-title">{{$item->title}}</h5>@endif
        <div class="{{$item->fixed_size?'news-content':''}}">
            {!!$item->content!!}
        </div>
        @if(!$item->title_on_top)<h5 class="card-title">{{$item->title}}</h5>@endif
        <p class="card-text">{{$item->description}}</p>
        <p class="card-text"><small class="text-muted">{{$item->published->format('Y-m-d')}}</small></p>
    </div>
</div>
