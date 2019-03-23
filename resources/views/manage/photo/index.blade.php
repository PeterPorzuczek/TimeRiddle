@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Photos</div>
<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="/manage">
            Back
        </a>
    </div>
    <div class="row col-2 mr-2">
        <a class="btn btn-success" href="photos/create">
            Add
        </a>
    </div>
</div>
@endsection
@section('card-content')
    @if(!empty($photos))
        <div class="container">
            @foreach($photos as $photo)
                @if(!empty($photo))
                <div>
                    <div class="row">
                        <h3>{{ $photo->name }}</h3>
                    </div>
                    <div class="row mb-2">
                        <img class="" style="max-width: 100%; border-radius: 5px; max-height: 200px;" alt="{{$photo->name}}" src="/storage/photos/{{ $photo->file_name }}">
                    </div>
                    <div class="row mb-2">
                        <form method="POST" action="photos/{{$photo->id}}" onsubmit="return confirm('Do you really want to delete?');">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif
@endsection
