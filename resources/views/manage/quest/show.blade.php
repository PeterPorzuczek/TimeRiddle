@extends('layouts.manage-card')

@section('card-header')
<div class="card-header">Quest details</div>

<div class="container d-flex justify-content-start m-2">
    <div class="row col-2 mr-2">
        <a class="btn btn-default" href="{{ route('quests.filter', $quest->topic->course_id) }}">
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
    @if(!empty($quest))
    <div>
        <div class="mb-4">
            <div class="row">Course Name</div>
            <div class="row">{{ $quest->topic->course->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Topic Name</div>
            <div class="row">{{ $quest->topic->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Quest Name</div>
            <div class="row">{{ $quest->name }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Content (Markdown)</div>

            @if($quest->show_code)
            <div class="row">
                {!! $quest->content_html !!}
            </div>
            @endif

            @if(!$quest->show_code)
            <div class="row">
                {!! $quest->content_html_no_code !!}
            </div>
            @endif

            <div class="row">
                <textarea  rows="20" cols="50" type="text" disabled style="width: 100%; background: white; border: none;">{{{ $quest->content }}}</textarea>
            </div>
        </div>

        <div class="mb-4">
            <div class="row">Links (Json with 1 level)</div>
            <div class="row">{{ $quest->links }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Show code</div>
            <div class="row">{{ $quest->show_code }}</div>
        </div>

        <div class="mb-4">
            <div class="row">Public</div>
            <div class="row">{{ $quest->public }}</div>
        </div>

        <div class="row mb-2">
            <a href="{{ $quest->id }}/edit" class="btn btn-success mr-2">Edit</a>
            <form method="POST" action="{{action('QuestController@destroy', $quest->id)}}" onsubmit="return confirm('Do you really want to delete?');">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>
    @endif
</div>
@endsection
