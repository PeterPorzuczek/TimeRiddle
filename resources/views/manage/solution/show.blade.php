@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Solution details</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="{{ url()->previous() }}">
            Back
        </a>
    </div>
    <div class="row col-2 mr-2">
        <button class="btn btn-default" onclick="addToggle()">
            Add toggle
        </button>
    </div>
</div>
@endsection

@section('card-content')

<div class="container" style="min-width: 228px;">
    @if(!empty($solution))
    <div>
        <div class="mb-4">
            <div class="row">Course Name</div>
            <div class="row">{{ $solution->problem->quest->topic->course->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Topic Name</div>
            <div class="row">{{ $solution->problem->quest->topic->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Quest Name</div>
            <div class="row">{{ $solution->problem->quest->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Problem Name</div>
            <div class="row">{{ $solution->problem->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Password</div>
            <div class="row">{{ $solution->password }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Mark</div>
            <div class="row">{{ $solution->mark }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Link</div>
            <div class="row">{{ $solution->link }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Summary (Markdown)</div>

            <div class="row">
                {!! $solution->summary_html !!}
            </div>

            <div class="row">
                <textarea  rows="20" cols="50" type="text" disabled style="width: 100%; background: white; border: none;">{{{ $solution->summary }}}</textarea>
            </div>
        </div>

        <div class="row mb-2">
            <a href="{{ $solution->id }}/edit" class="btn btn-success mr-2">Edit</a>
            <form method="POST" action="{{action('SolutionController@destroy', $solution->id)}}" onsubmit="return confirm('Do you really want to delete?');">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
    @endif
</div>
@endsection
