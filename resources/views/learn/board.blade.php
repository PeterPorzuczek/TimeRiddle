@extends('layouts.app')

@section('app-content')
<board
      course-learn-endpoint="{{ url('/learn') }}"
      course-password="{{$coursePassword}}"
      course-abbreviation="{{$courseName}}"/>
@endsection
