<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#donate{{$i}}">
Donate history
</button>
<!-- Modal -->
<div class="modal fade" id="donate{{$i}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Donate list</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @foreach($moneys as $mn)
            @if($mn->history_id == $h->id)
            <div>
                @foreach($users as $us)
                @if($us->id == $mn->user_id)
                {{$us->name}}
                {{-- {{$mn->user_id}} --}}
                @endif
                @endforeach
            </div>
            <div>
                &#x20AC; {{number_format($mn->money, 2, '.', ' ')}}
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
