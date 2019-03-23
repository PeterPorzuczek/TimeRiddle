@extends('layouts.manage-card')

@section('card-header')
    <div class="card-header">Courses</div>
    <div class="container d-flex justify-content-start m-2">
        <div class="row col-2 mr-2">
            <a class="btn btn-default" href="/manage">
                Back
            </a>
        </div>
        <div class="row col-2 mr-2">
            <a class="btn btn-success" href="courses/create">
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
                            <h6><a href="{{ url('/board') }}/{{$course->abbreviation}}/{{$course->password}}">{{ url('/board') }}/{{$course->abbreviation}}/{{$course->password}}</a></h6>
                            <h6><a href="{{ url('/learn') }}/{{$course->abbreviation}}/{{$course->password}}">{{ url('/learn') }}/{{$course->abbreviation}}/{{$course->password}}</a></h6>
                        </div>
                        <div class="row mb-2">
                            <a href="courses/{{ $course->id }}" class="btn btn-info mr-2">Detail</a>
                            <a href="courses/{{ $course->id }}/edit" class="btn btn-success mr-2">Edit</a>
                            <form method="POST" action="courses/{{$course->id}}" onsubmit="return confirm('Do you really want to delete?');">
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
