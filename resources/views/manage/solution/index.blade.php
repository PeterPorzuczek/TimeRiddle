@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Problems</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-2 mr-2">
            <a class="btn btn-default"
                @if (!empty($courseId) && !empty($topicId) && !empty($questId))
                href="{{ route('problems.quests.topics.filter', ['topicId'=>$topicId, 'courseId'=>$courseId, 'questId'=>$questId]) }}"
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
                href="{{ route('solutions.create',  ['courseId'=>$courseId,'topicId'=>$topicId, 'questId'=>$questId]) }}"
                @elseif(!empty($courseId))
                href="{{ route('solutions.create',  ['courseId'=>$courseId]) }}"
                @else
                href="{{ route('solutions.create') }}"
                @endif
                >
                Add
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        @if(!empty($solutions))
            @foreach($solutions->sortBy('index') as $solution)
                @if(!empty($solution))
                    <div>
                        <div class="row">
                            <h4>
                                Mark: {{ $solution->mark }} - {{ $solution->password }} - problem: {{ $solution->problem->name }} - quest: {{ $solution->problem->quest->name }} - topic: <strong>{{ $solution->problem->quest->topic->name }}</strong> - course: <em>{{ $solution->problem->quest->topic->course->name }}</em>
                            </h4>
                        </div>
                        <div class="row mb-2">
                            <a href="{{ route('solutions.show', $solution->id) }}" class="btn btn-info mr-2">Detail</a>
                            <a href="{{ route('solutions.edit', $solution->id) }}" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="{{action('SolutionController@destroy', $solution->id)}}" onsubmit="return confirm('Do you really want to delete?');">
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
