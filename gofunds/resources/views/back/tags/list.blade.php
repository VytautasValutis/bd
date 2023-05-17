@forelse($tags as $tag)
<li class="list-group-item">
    <div class="cat-line">
        <div class="cat-info">
        <form action="{{route('tags-update', $tag)}}" method="post">
        <input type="text" value="{{$tag->text}}" name="title">
        </div>
        <div class="buttons">
            <button type="submit" class="btn btn-outline-success">edit</button>
             @csrf
            @method('put')
            </form>
            <form action="{{route('tags-deleteHt', $tag)}}" method="post">
            <button type="submit" class="btn btn-outline-danger">delete</button>
            @csrf
            @method('delete')
            </form>
        </div>
    </div>
</li>
@empty
<li class="list-group-item">
    <div class="cat-line">No Tags</div>
</li>
@endforelse