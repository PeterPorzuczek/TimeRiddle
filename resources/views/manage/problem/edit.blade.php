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

<form class="container"action="{{action('ProblemController@update', $problem->id )}}" method="POST" enctype="multipart/form-data" onsubmit="return isValidJson()">
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
        <label>Topic</label>
        <select class="form-control" name="quest_id">
            @if(count($quests) > 0)
                @foreach($quests as $quest)
                    <option value="{{$quest->id}}"
                    @if ($quest->id === $problem->quest_id)
                        selected="selected"
                    @endif
                    >{{$quest->name}} - {{$quest->topic->name}} - {{$quest->topic->course->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label>Passwords</label>
        <input type="text" name="passwords" class="form-control" value="{{$problem->passwords}}">
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{$problem->name}}">
    </div>

    <div class="form-group">
        <label>Index</label>
        <input type="number" name="index" class="form-control" value="{{$problem->index}}">
    </div>

    <div class="form-group">
        <label>Content (Markdown)</label>
        <textarea rows="25" cols="50" type="text" name="content" class="form-control">{{{ $problem->content }}}</textarea>
    </div>

    <div class="form-group">
        <label>Links (Json with 1 level)</label>
        <textarea rows="4" cols="50" type="text" name="links" class="form-control jsonarea">{{$problem->links}}</textarea>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="show_code" name="show_code" value="show_code"
        @if ($problem->show_code)
            checked
        @endif>
        <label class="form-check-label" for="public">Show code</label>
    </div>

    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="public" name="public" value="public"
        @if ($problem->public)
            checked
        @endif>
        <label class="form-check-label" for="public">Public</label>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
