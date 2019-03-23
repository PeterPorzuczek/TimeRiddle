@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Topics</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-2 mr-2">
            <a class="btn btn-default" href="/manage">
                Back
            </a>
        </div>
        <div class="row col-2 mr-2">
            <a class="btn btn-success" href="topics/create">
                Add
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        @if(!empty($topics))
            @foreach($topics as $topic)
                @if(!empty($topic))
                    <div>
                        <div class="row">
                            <h4>
                                <strong>{{ $topic->name }}</strong> - course: <em>{{ $topic->course->name }}</em> - quests: {{ count($topic->quests) }}
                            </h4>
                        </div>
                        <div class="row mb-2">
                            <a href="topics/{{ $topic->id }}" class="btn btn-info mr-2">Detail</a>
                            <a href="topics/{{ $topic->id }}/edit" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="topics/{{$topic->id}}" onsubmit="return confirm('Do you really want to delete?');">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
