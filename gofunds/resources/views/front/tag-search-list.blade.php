@foreach($tags as $tag)
<div class="list-tag --list--tag" data-id={{$tag->id}}>{{$tag->text}}</div>
@endforeach