@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Problems</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-2 mr-2">
            <a class="btn btn-default"
                @if (!empty($courseId) && !empty($topicId))
                href="{{ route('quests.topics.filter', ['topicId'=>$topicId, 'courseId'=>$courseId]) }}"
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
                href="{{ route('problems.create',  ['courseId'=>$courseId,'topicId'=>$topicId, 'questId'=>$questId]) }}"
                @elseif(!empty($courseId))
                href="{{ route('problems.create',  ['courseId'=>$courseId]) }}"
                @else
                href="{{ route('problems.create') }}"
                @endif
                >
                Add
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        @if(!empty($problems))
            @foreach($problems->sortBy('index') as $problem)
                @if(!empty($problem))
                    <div>
                        <div class="row">
                            <h4>
                                {{ $problem->name }} - quest: {{ $problem->quest->name }} - topic: <strong>{{ $problem->quest->topic->name }}</strong> - course: <em>{{ $problem->quest->topic->course->name }}</em>
                            </h4>
                        </div>
                        <div class="row mb-2">
                            <a href="{{ route('problems.show', $problem->id) }}" class="btn btn-info mr-2">Detail</a>
                            <a href="{{ route('problems.edit', $problem->id) }}" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="{{action('ProblemController@destroy', $problem->id)}}" onsubmit="return confirm('Do you really want to delete?');">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('solutions.problems.quests.topics.filter', ['courseId' => $problem->quest->topic->course_id, 'topicId' => $problem->quest->topic->id, 'questId' => $problem->quest->id, 'problemId' => $problem->id]) }}" class="btn btn-warning ml-2">Solutions</a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
