@extends('home.main')
@section('title')
@endsection

@section('content')
    <div class="about">
        <div class="panel-body">
            <br><br><br><br>
            <div class="panel panel-default uk-margin-large-top uk-margin-large-bottom" style="background: {{$color}}">
                <div class="panel-body text-center">
                    <h2 class="text-primary margin-top margin-bottom">{{$message}}</h2>

                </div>

            </div>
        </div>
        <br><br><br><br><br><br>

    </div>

@endsection