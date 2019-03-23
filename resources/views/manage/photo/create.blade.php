@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Add photo</div>
<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="/photos">
            Back
        </a>
    </div>
</div>

@endsection

@section('card-content')

<form class="container"action="{{action('PhotoController@store')}}" method="POST" enctype="multipart/form-data">

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
        <label>Add file</label>
        <input type="file" name="file" multiple class="form-control">
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="public" name="public" value="public">
        <label class="form-check-label" for="public">public</label>
    </div>

    <div class="form-group">
        <button class="btn btn-success">Save</button>
    </div>

</form>

@endsection
