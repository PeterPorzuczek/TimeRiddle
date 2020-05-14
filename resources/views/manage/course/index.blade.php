@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Courses</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-6 mr-2">
            <a class="btn btn-success" href="{{ route('courses.create') }}">
                Add
            </a>
        </div>
    </div>
@endsection
@section('card-content')
    <div class="container">
        @if(!empty($courses))
            @foreach($courses as $course)
                @if(!empty($course))
                    <div>
                        <div class="row" data-turbolinks="false">
                            <h4>
                                <em>{{ $course->name }}</em> - topics: {{ count($course->topics) }}
                            </h4>
                            <h5>
                                <em>{{ $course->description }}</em>
                            </h5>
                            <h6><a href="{{ url('/board') }}/{{$course->abbreviation}}/{{$course->password}}" target="_blank">{{ url('/board') }}/{{$course->abbreviation}}/{{$course->password}}</a></h6>
                            <h6><a href="{{ url('/learn') }}/{{$course->abbreviation}}/{{$course->password}}" target="_blank">{{ url('/learn') }}/{{$course->abbreviation}}/{{$course->password}}</a></h6>
                        </div>
                        <div class="row mb-2 pt-2">
                            <a href="courses/{{ $course->id }}" class="btn btn-info mr-2" target="_blank">Detail</a>
                            <a href="courses/{{ $course->id }}/edit" class="btn btn-success mr-2" target="_blank">Edit</a>
                            <form method="POST" action="courses/{{$course->id}}" onsubmit="return confirm('Do you really want to delete?');">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger mr-2">Delete</button>
                            </form>
                            <a href="{{ route('topics.filter', $course->id) }}" class="btn btn-primary mr-2" target="_blank">Topics</a>
                            <a href="{{ route('quests.filter', $course->id) }}" class="btn btn-warning mr-2" target="_blank">Quests</a>
                        </div>
                        <hr />
                    </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
