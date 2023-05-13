@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Add/Edit Your History<span class="ms-4 fs-4">User {{$user->name}}</span></h1>
                </div>
                <div class="card-body">
                    <div>
                        Select/change hash tags:
                        {{-- @include('front.tags') --}}
                    </div>
                    <div class="mb-3">
                        <form action="" method='post'>
                            <label class="form-label">Example textarea</label>
                            <textarea class="form-control" name="story" value="{{$hist->story}}" rows="5"></textarea>
                            <button type="submit" class="btn btn-outline-danger mt-1">Submit</button>
                            <button type="submit" class="btn btn-outline-danger mt-1">AI</button>
                            @csrf
                            @method('put')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
