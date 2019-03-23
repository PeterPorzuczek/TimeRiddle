@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Course details</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="/courses">
            Back
        </a>
    </div>
</div>
@endsection

@section('card-content')

<div class="container">
    @if(!empty($course))
    <div>
        <div class="mb-4">
            <div class="row">Name</div>
            <div class="row">{{ $course->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Abbreviation</div>
            <div class="row">{{ $course->abbreviation }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Password</div>
            <div class="row">{{ $course->password }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Links (Json with 1 level)</div>
            <div class="row">{{ $course->links }}</div>
        </div>

        <div class="row mb-2">
            <a href="{{ $course->id }}/edit" class="btn btn-success mr-2">Edit</a>
            <form method="POST" action="{{$course->id}}" onsubmit="return confirm('Do you really want to delete?');">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
    @endif
</div>

@endsection
