@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">New course</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="{{ route('topics.filter', $topic->course_id) }}">
            Back
        </a>
    </div>
</div>

@endsection

@section('card-content')

<form class="container"action="{{action('TopicController@update', $topic->id)}}" method="POST" enctype="multipart/form-data" onsubmit="return isValidJson()">
    <input type="hidden" name="_method" value="PUT">
    {{csrf_field()}}

    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endforeach
    @endif

    <div class="form-group">
        <label>Course</label>
        <select class="form-control" name="course_id">
            @if(count($courses) > 0)
                @foreach($courses as $course)
                    <option value="{{$course->id}}"
                    @if ($course->id === $topic->course_id)
                        selected="selected"
                    @endif
                    >{{$course->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{$topic->name}}">
    </div>

    <div class="form-group">
        <label>Index</label>
        <input type="number" name="index" class="form-control" value="{{$topic->index}}">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea rows="4" cols="50" type="text" name="description" class="form-control">{{$topic->description}}</textarea>
    </div>

    <div class="form-group">
        <label>Links (Json with 1 level)</label>
        <textarea rows="4" cols="50" type="text" name="links" class="form-control jsonarea">{{$topic->links}}</textarea>
    </div>


    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="public" name="public" value="public"
        @if ($topic->public)
            checked
        @endif>
        <label class="form-check-label" for="public">Public</label>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
