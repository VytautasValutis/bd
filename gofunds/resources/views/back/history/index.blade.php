@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-11">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Author</th>
                    <th scope="col" class="w-50">Story</th>
                    <th scope="col" class="w-25">Main picture nad gallery up to five photo</th>
                    <th scope="col">Need money</th>
                    <th scope="col">Likes</th>
                    <th scope="col">Have money</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $h)
                <tr>
                    <td>
                        @foreach($users as $u)
                        @if($h->user_id == $u->id)
                        <div>{{$u->name}}
                        </div>
                        @endif
                        @endforeach
                    </td>
                    <td>
                        <div>{{$h->story}} </div>
                    </td>
                    <td>
                        <div class="gallery">
                            <div class="photo">
                                <div>
                                    @if($h->photo)
                                    <img src="{{asset('history-photo') .'/t_'. $h->photo}}">
                                    @else
                                    <img src="{{asset('history-photo') .'/no.jpg'}}">
                                    @endif
                                </div>
                                @foreach($gallery as $k => $g)
                                @if($g->hist_id == $h->id)
                                <button type="button" class="btn btn-overlay-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$k}}">
                                    <img class="img-responsive" src="{{asset('history-photo') .'/'. $g->photo}}">
                                </button>
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
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-outline-danger">delete</button>
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                    @if(!$h->approved)
                    <td>
                        <a href="" class="btn btn-outline-success">Approve</a>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <div class="ht-line">
                            <div class="ht-element">
                                @foreach($hts as $htg)
                                @foreach($ht_pivots as $ht)
                                @if($ht->histories__id == $h->id && $htg->id == $ht->hts__id)
                                @if($htf == $htg->id)
                                <div class="btn btn-success ms-2">
                                    {{$htg->text}}
                                </div>
                                @else
                                <div class="btn btn-outline-success ms-2">
                                    {{$htg->text}}
                                </div>
                                @endif
                                @endif
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="button-line">
                            <div class="buttons">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#donate">
                                    Donate history
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="donate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                @if($us->id == $mn->user_id && )
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
                                </div>
                                <a href="" class="btn btn-outline-primary">Add donate</a>
                                <a href="" class="btn btn-outline-primary">Like</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="width: 6rem;">
                            &#x20AC; {{number_format($h->need_money, 2, '.', ' ')}}
                        </div>
                    </td>
                    <td><b> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-balloon-heart-fill text-danger" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z" />
                            </svg>
                        </b>{{$likes->where('history_id', $h->id)->count()}}</td>
                    <td>
                        <div style="width: 6rem;">
                            &#x20AC; {{number_format(
                                $moneys->where('history_id', $h->id)->sum('money')
                                , 2, '.', ' ')}}
                        </div>
                    </td>
                    <td></td>

                </tr>
                @empty
                <th>No histories</th>
                @endforelse
            </tbody>
        </table>
        <div class="m-2">
            {{ $histories->links() }}
        </div>

    </div>
</div>
@endsection
