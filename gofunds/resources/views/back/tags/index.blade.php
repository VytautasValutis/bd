@extends('layouts.back')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Add Tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('tags-create')}}" method="post">
                    <div class="mb-3">
                        <label class="form-label">Tag</label>
                        <input type="text" class="form-control" name="title">
                        <div class="form-text">Please add history tag here</div>
                    </div>
                    <button type="submit" class="mt-1 btn btn-outline-primary">Add</button>
                    @csrf
                    </form>
                    <a class="mt-1 btn btn-outline-primary" href="{{route('history-index')}}">Return to history list</a>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Tags List</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group --tags--list" data-url="{{route('tags-list')}}">
                    @include('back.tags.list')
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="loader">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<div class="--modal--bin"></div>
<div class="--messages--bin messages-container">
@include('layouts.js-messages')
</div>
@endsection