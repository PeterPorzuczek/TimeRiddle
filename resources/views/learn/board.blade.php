@extends('layouts.app')

@section('app-content')
<board
      course-learn-endpoint="{{ url('/learn') }}"
      course-abbreviation="{{$courseName}}"
      course-password="{{$coursePassword}}"/>
@endsection
