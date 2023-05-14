    @foreach($gallery as $k => $g)
    <button type="button" class="btn btn-overlay-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$k}}">
        <img class="img-responsive" src="{{asset('history-photo') . '/'. $g->photo}}">
    </button>
        <a href="{{route('front-delete-photo', ['photo' => $g, 'hist' => $hist])}}" class="btn btn-outline-danger btn-xs">x</a>

    <div class="modal fade" id="exampleModal{{$k}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn btn-md btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-responsive" src="{{asset('history-photo') .'/'. $g->photo}}">
                </div>
            </div>
        </div>
    </div>
    @endforeach
