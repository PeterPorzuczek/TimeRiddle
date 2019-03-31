@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">New course</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="/courses">
            Back
        </a>
    </div>
</div>
@endsection

@section('card-content')

<form class="container"action="{{action('CourseController@store')}}" method="POST" enctype="multipart/form-data" onsubmit="return isValidJson()">

    {{csrf_field()}}

    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endforeach
    @endif

    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
        <label>Abbreviation</label>
        <input type="text" name="abbreviation" class="form-control">
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>Links (Json with 1 level)</label>
        <textarea rows="4" cols="50" type="text" name="links" class="form-control jsonarea">{}</textarea>
    </div>

    <div class="form-group">
        <label>Theme</label>
        <select class="form-control" name="theme">
            @if(count($themes) > 0)
                @foreach($themes as $theme)
                    <option value="{{$theme}}">{{$theme}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-check pb-4">
        <input type="checkbox" class="form-check-input" id="dark" name="dark" value="dark">
        <label class="form-check-label" for="public">Dark</label>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
