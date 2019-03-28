@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Quests</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-2 mr-2">
            <a class="btn btn-default"
                @if(!empty($courseId))
                href="{{ route('topics.filter', $courseId) }}"
                @else
                href="{{ route('courses.index') }}"
                @endif
                >
                Back
            </a>
        </div>
        <div class="row col-2 mr-2">
            <a class="btn btn-success"
                @if(!empty($courseId) && !empty($topicId))
                href="{{ route('quests.create',  ['courseId'=>$courseId,'topicId'=>$topicId]) }}"
                @elseif(!empty($courseId))
                href="{{ route('quests.create',  ['courseId'=>$courseId]) }}"
                @else
                href="{{ route('quests.create') }}"
                @endif
                >
                Add
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        @if(!empty($quests))
            @foreach($quests as $quest)
                @if(!empty($quest))
                    <div>
                        <div class="row">
                            <h4>
                                {{ $quest->name }} - topic: <strong>{{ $quest->topic->name }}</strong> - course: <em>{{ $quest->topic->course->name }}</em>
                            </h4>
                        </div>
                        <div class="row mb-2">
                            <a href="{{ route('quests.show', $quest->id) }}" class="btn btn-info mr-2">Detail</a>
                            <a href="{{ route('quests.edit', $quest->id) }}" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="{{action('QuestController@destroy', $quest->id)}}" onsubmit="return confirm('Do you really want to delete?');">
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
