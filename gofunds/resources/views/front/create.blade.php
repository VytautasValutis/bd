@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="container">
                            <div class="row">
                                <div class="col col-6">
                                    <h1>Add/Edit Your History<span class="ms-4 fs-4">User {{$user->name}}</span>
                                        {{$hist->photo}}
                                        @if($hist->photo)
                                        <img src="{{asset('history-photo') .'/t_'. $hist->photo}}">
                                        @else
                                        <img src="{{asset('history-photo') .'/t_no_photo.jpg'}}">
                                        @endif
                                    </h1>
                                </div>
                                <div class="col col-6">
                                    <label class="form-label">Main Cat photo</label>
                                    <input type="file" class="form-control" name="photo">
                                    <button type="submit" name="delete" value="1" class="mt-2 btn btn-outline-danger">Delete photo</button>
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
                        <div class="mb-3" data-gallery="0">
                            <label class="form-label">Gallery photo <span class="rem">X</span></label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="gallery-inputs">

                        </div>

                        <button type="button" class="btn btn-secondary --add--gallery">add gallery photo</button>

                    </div>
                        <button type="submit" class="btn btn-outline-danger m-1 ms-3">Submit</button>
                        <button type="submit" class="btn btn-outline-danger m-1">AI</button>
                    @csrf
                    @method('put')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
