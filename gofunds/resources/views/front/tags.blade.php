<div class="tags --tags" data-url="{{route('front-delete-tag', $hist)}}">
    @foreach($tags as $tag)
    <div class="tag --tag" data-id="{{$tag->id}}">{{$tag->text}}<i></i></div>
    @endforeach
    <div class="add --add">
        <input type="text" class="--add--new" data-url="{{route('front-tags-list')}}">
        <div class="btn btn-info --newtag" data-url="{{route('front-add-new-tag', $hist)}}">add #</div>
        {{-- <button type="button" class="btn btn-info --newtag" data-url="{{route('front-add-new-tag', $hist)}}">add #</button> --}}
        <div class="list --tags--list" data-url="{{route('front-add-tag', $hist)}}">
        </div>
    </div>
</div>