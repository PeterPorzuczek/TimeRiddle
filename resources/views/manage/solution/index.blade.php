@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Solutions</div>
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
        <div class="row col-2 mr-2">
            <a class="btn btn-info"
                href="{{ route('solutions.index') }}"
                >
                All
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        <h3 style="padding-bottom: 10px; display: flex; flex-direction: column">
        <div style="color: red; display: inline-flex"><div style="width: 150px;">Unchecked: </div>{{ $solutions->filter(function ($solution) { return empty($solution->mark); })->count() }}/{{ $solutions->count() }}</div>
        <div style="color: green; display: inline-flex"><div style="width: 150px;">Checked: </div>{{ $solutions->count() - $solutions->filter(function ($solution) { return empty($solution->mark); })->count() }} / {{ $solutions->count() }}</div>
        </h3>
        @if(!empty($solutions))
            @foreach($solutions as $solution)
                @if(!empty($solution))
                    <div  style="padding-bottom: 10px">
                        <div class="row" style="padding-bottom: 10px">
                            <h4 style="display: inline-flex">
                                <div style="width: 150px; color: {{ empty($solution->mark) ? 'red' : (strpos($solution->mark, '2') !== false || strpos($solution->mark, 'nzal') !== false ? 'blue' : 'green') }}">Mark: {{ $solution->mark }}</div><div style="width: 150px">{{ $solution->problem->name }}</div><div style="width: 50px; color: {{ $solution->quantity > 1 ? 'red' : 'black' }}">{{  $solution->quantity }}</div>{{ $solution->password }}
                            </h4>
                            <h6>
                                solution: <a href="{{ $solution->link }}" target="_blank">{{ $solution->link }}</a>
                            </h6>
                            <h6>
                                quest: {{ $solution->problem->quest->name }} - topic: <strong>{{ $solution->problem->quest->topic->name }}</strong> - created: {{ $solution->created_at }}
                            </h6>
                            <h6>
                                description: <em>{{ $solution->problem->quest->topic->course->description }}</em> - course: <em>{{ $solution->problem->quest->topic->course->name }}</em> - link: <a href="{{ url('/board') }}/{{$solution->problem->quest->topic->course->abbreviation}}/{{$solution->problem->quest->topic->course->password}}" target="_blank">{{ url('/board') }}/{{$solution->problem->quest->topic->course->abbreviation}}/{{$solution->problem->quest->topic->course->password}}</a>
                            </h6>
                        </div>
                        <div class="row mb-2">
                            <a href="{{ route('solutions.show', $solution->id) }}" class="btn btn-info mr-2">Detail</a>
                            <a href="{{ route('solutions.edit', $solution->id) }}" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="{{action('SolutionController@destroy', $solution->id)}}" onsubmit="return confirm('Do you really want to delete?');">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('problems.show', $solution->problem->id) }}" class="btn btn-warning ml-2">Problem</a>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
