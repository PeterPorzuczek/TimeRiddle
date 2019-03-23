@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">New course</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="/quests">
            Back
        </a>
    </div>
</div>
@endsection

@section('card-content')

<form class="container"action="{{action('QuestController@update', $quest->id )}}" method="POST" enctype="multipart/form-data" onsubmit="return isValidJson()">
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
        <select class="form-control" name="topic_id">
            @if(count($topics) > 0)
                @foreach($topics as $topic)
                    <option value="{{$topic->id}}"
                    @if ($topic->id === $quest->topic_id)
                        selected="selected"
                    @endif
                    >{{$topic->name}} - {{$topic->course->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{$quest->name}}">
    </div>

    <div class="form-group">
        <label>Index</label>
        <input type="number" name="index" class="form-control" value="{{$quest->index}}">
    </div>

    <div class="form-group">
        <label>Content (Markdown)</label>
        <textarea rows="25" cols="50" type="text" name="content" class="form-control">{{{ $quest->content }}}</textarea>
    </div>

    <div class="form-group">
        <label>Links (Json with 1 level)</label>
        <textarea rows="4" cols="50" type="text" name="links" class="form-control jsonarea">{{$quest->links}}</textarea>
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="show_code" name="show_code" value="show_code"
        @if ($quest->show_code)
            checked
        @endif>
        <label class="form-check-label" for="public">Show code</label>
    </div>

    <div class="form-check mb-4">
        <input type="checkbox" class="form-check-input" id="public" name="public" value="public"
        @if ($quest->public)
            checked
        @endif>
        <label class="form-check-label" for="public">Public</label>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
