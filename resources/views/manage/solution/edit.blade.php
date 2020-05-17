@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">New course</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="{{ url()->previous() }}">
            Back
        </a>
    </div>
</div>
@endsection

@section('card-content')

<form class="container"action="{{action('SolutionController@update', $solution->id )}}" method="POST" enctype="multipart/form-data" onsubmit="return isValidJson()">
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
        <label>Problem</label>
        <select class="form-control" name="problem_id">
            @if(count($problems) > 0)
                @foreach($problems as $problem)
                    <option value="{{$problem->id}}"
                    @if ($problem->id === $solution->problem_id)
                        selected="selected"
                    @endif
                    >{{$problem->name}} -{{$problem->quest->name}} - {{$problem->quest->topic->name}} - {{$problem->quest->topic->course->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control" value="{{$solution->password}}">
    </div>

    <div class="form-group">
        <label>Link</label>
        <input type="text" name="link" class="form-control" value="{{$solution->link}}">
    </div>

    <div class="form-group">
        <label>Mark</label>
        <input type="text" name="mark" class="form-control" value="{{$solution->mark}}">
    </div>

    <div class="form-group">
        <label>Summary (Markdown)</label>
        <textarea rows="25" cols="50" type="text" name="summary" class="form-control">{{{ $solution->summary }}}</textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
