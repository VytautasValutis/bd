@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <form action="{{route('front-update', $hist)}}" method="post" enctype="multipart/form-data" id="hist_edit">
                    <div class="card-header">
                        <div class="container">
                            <div class="row">
                                <div class="col col-6">
                                    <h2>Add/Edit Your History<span class="ms-4 fs-4">User {{$user->name}}</span>
                                        @if($hist->photo)
                                        <img src="{{asset('history-photo') .'/t_'. $hist->photo}}">
                                        @else
                                        <img src="{{asset('history-photo') .'/t_no_photo.jpg'}}">
                                        @endif
                                    </h2>
                                </div>
                                <div class="col col-4">
                                    <label class="form-label">Main photo</label>
                                    <input type="file" class="form-control" name="photo">
                                    <button type="submit" name="delete" value="1" class="mt-2 btn btn-outline-danger">Delete photo</button>
                                </div>
                                <div class="col col-2">
                                    <label>Need money</label>
                                    <input type="text" name='need_money' value='{{$hist->need_money}}' class="mt-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            Select/change hash tags:
                            {{-- @include('front.tags') --}}
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Edit Your history</label>
                            <textarea class="form-control" name="story" rows="5">{{$hist->story}}</textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-danger m-1" name="ai" value="1">AI</button>
                        </div>
                        Please add gallery photo
                        <div class="gallery-edit overflow-scroll">
                            @include('front.gggallery')
                        </div>
                        <div class="mt-3" data-gallery="0">
                            <div class="container">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Gallery photo <span class="rem">X</span></label>
                                    </div>
                                    <div class="col-8">
                                        <input type="file" class="form-control w-50">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-inputs">

                        </div>

                        <button type="button" class="btn btn-secondary --add--gallery mt-2">add gallery photo</button>

                    </div>
                    <button type="submit" class="btn btn-outline-danger m-1 ms-3" name="submit" value="1" form="hist_edit">Submit</button>
                    <button type="submit" class="btn btn-outline-danger m-1" formaction="{{route('home')}}" formmethod="get">End of editing</button>
                    @csrf
                    @method('put')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
