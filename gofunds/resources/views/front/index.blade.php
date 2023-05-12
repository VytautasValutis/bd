@extends('layouts.front')

@section('content')
<div class="row justify-content-center">
    <div class="col-11">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Author</th>
                    <th scope="col" class="w-50">Story</th>
                    <th scope="col" class="w-25">Main picture and gallery up to five photo</th>
                    <th scope="col"></th>
                    <th scope="col">Likes</th>
                    <th scope="col">Donates</th>
                    <th scope="col">funds</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $i => $hist)
                @if($hist->approved || $user_status->role <= 5) 
                @if($hist->lack_money <= 0)
                <tr class="table-active">
                @else
                <tr>
                @endif
                    <td>
                        @foreach($users as $u)
                        @if($hist->user_id == $u->id)
                        <div>{{$u->name}}</div>
                        @endif
                        @endforeach
                    </td>
                    <td>
                        <div>{{$hist->story}} </div>
                    </td>
                    <td>
                        <div class="gallery">
                            <div class="photo">
                                <div>
                                    @if($hist->photo)
                                    <img src="{{asset('history-photo') .'/t_'. $hist->photo}}">
                                    @else
                                    <img src="{{asset('history-photo') .'/no.jpg'}}">
                                    @endif
                                </div>
                                @include('front.gallery')
                            </div>
                        </div>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td colspan="2">
                        Need
                        <div style="width: 6rem;">
                            &#x20AC; {{number_format($hist->need_money, 2, '.', ' ')}}
                        </div>
                        Have
                        <div style="width: 6rem;">
                            &#x20AC; {{number_format($hist->have_money, 2, '.', ' ')}}
                        </div>
                    </td>
                    </tr>
                @if($hist->lack_money <= 0)
                <tr class="table-active">
                @else
                <tr>
                @endif
                        <td>
                        </td>
                        <td>
                            <div class="ht-line">
                                <div class="ht-element">
                                    @foreach($hts as $htg)
                                    @foreach($ht_pivots as $ht)
                                    @if($ht->histories__id == $hist->id && $htg->id == $ht->hts__id)
                                    @if($htf == $htg->id)
                                    <div class="tag red">
                                        {{$htg->text}}
                                    </div>
                                    @else
                                    <div class="tag">
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
                                    @include('front.donateHistory')
                                </div>
                                @if($hist->lack_money > 0)
                                @include('front.donate')
                                @endif
                                @include('front.like')
                            </div>
                        </td>
                        <td>
                        </td>
                        <td><b> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-balloon-heart-fill text-danger" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.49 10.92C19.412 3.382 11.28-2.387 8 .986 4.719-2.387-3.413 3.382 7.51 10.92l-.234.468a.25.25 0 1 0 .448.224l.04-.08c.009.17.024.315.051.45.068.344.208.622.448 1.102l.013.028c.212.422.182.85.05 1.246-.135.402-.366.751-.534 1.003a.25.25 0 0 0 .416.278l.004-.007c.166-.248.431-.646.588-1.115.16-.479.212-1.051-.076-1.629-.258-.515-.365-.732-.419-1.004a2.376 2.376 0 0 1-.037-.289l.008.017a.25.25 0 1 0 .448-.224l-.235-.468ZM6.726 1.269c-1.167-.61-2.8-.142-3.454 1.135-.237.463-.36 1.08-.202 1.85.055.27.467.197.527-.071.285-1.256 1.177-2.462 2.989-2.528.234-.008.348-.278.14-.386Z" />
                                </svg>
                            </b>{{$hist->like}}
                        </td>
                        @if($hist->lack_money > 0)
                        <td colspan="2" class="table-info">
                            Lack of 
                        <div style="width: 6rem;">
                            &#x20AC; {{number_format($hist->lack_money, 2, '.', ' ')}}
                        </div>
                        @else
                        <td colspan="2" class="table-light">
                        <div style="color: red">
                            funds collected
                        </div>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div class="line">
                            </div>
                        </td>
                    </tr>
                    @endif
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
