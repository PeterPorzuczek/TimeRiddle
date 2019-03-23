@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Course details</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="{{ route('topics.filter', $topic->course_id) }}">
            Back
        </a>
    </div>
</div>
@endsection

@section('card-content')

<div class="container">
    @if(!empty($topic))
    <div>
        <div class="mb-4">
            <div class="row">Course Name</div>
            <div class="row">{{ $topic->course->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Topic Name</div>
            <div class="row">{{ $topic->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Description</div>
            <div class="row">
                {!! $topic->description_html !!}
            </div>
        </div>

        <div class="mb-4">
            <div class="row">Links (Json with 1 level)</div>
            <div class="row">{{ $topic->links }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Public</div>
            <div class="row">{{ $topic->public }}</div>
        </div>

        <div class="row mb-2">
            <a href="{{ $topic->id }}/edit" class="btn btn-success mr-2">Edit</a>
            <form method="POST" action="{{action('TopicController@destroy', $topic->id)}}" onsubmit="return confirm('Do you really want to delete?');">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
    @endif
</div>

@endsection
