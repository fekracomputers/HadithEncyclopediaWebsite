@extends('home.main')
@section('description')
    موسوعة الحديث , أضف تعليقك
@endsection
@section('keywords')
    موسوعة الحديث, تعليق
@endsection
@section('title')
@endsection

@section('content')
    <div class="authors">
        <div class="panel-body uk-margin-bottom">
            @if(Session::has('status'))
                <div class="alert alert-success">
                    <p>{!! Session::get('status') !!}</p>
                </div>
                @endif
            <form class="uk-margin-large-top uk-margin-large-bottom"
            method="post" action="{{action('HomeController@addComment')}}">
                {{csrf_field()}}
                <input type="hidden" value="{{$url}}" name="url">
                <input type="hidden" value="{{$type}}" name="type">
                <input type="hidden" value="{{$label}}" name="label">
                <div class="form-group">
                    <label for="exampleInputEmail1">البريد الألكتروني</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">التعليق</label>
                    <textarea class="form-control" rows="5" name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection