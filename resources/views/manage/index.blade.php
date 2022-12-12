@extends('layouts.manage-card')

    @section('card-header')
        <div class="card-header">Dashboard</div>
    @endsection

    @section('card-content')
        <div class="container">

            <div class="row">
                <div class="d-flex justify-content-center col-sm-12 col-md-3 mb-3">
                    <a class="btn btn-primary" href="/t/management/courses">
                        courses
                    </a>
                </div>
                <div class="d-flex justify-content-center col-sm-12 col-md-3 mb-3">
                    <a class="btn btn-secondary" href="/topics">
                        topics
                    </a>
                </div>
                <div class="d-flex justify-content-center col-sm-12 col-md-3 mb-3">
                    <a class="btn btn-success" href="/quests">
                        quests
                    </a>
                </div>
            </div>

            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>

        </div>
    @endsection
