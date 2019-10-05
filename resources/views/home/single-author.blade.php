@extends('home.main')
@section('title')
    : {{$author[0]->name}}
@endsection

@section('content')

    <div>
        <img src="{{asset('dist/img/bannar.png')}}" alt="bannar" title="الرواة" class="img-bannar">
    </div>    <!--end slideshow -->


    <div class="books">
        <div class="booksinfo ">
            @foreach($author as $row)
                <h4>أسم المؤلف : <span class="text-info"> {{$row->name}}</span></h4>
            @if($row->deathhigriyear != -1)
                <h4>عام الوفاة : <span class="text-info"> {{$row->deathhigriyear}}</span><span> هجري </span></h4>
            @endif
            @endforeach

        </div>
        <br>
        @if(!empty($book))
            <div id="books" class="row uk-margin-top">
                @foreach($book as $row)
                    <div class="col-md-4 col-sm-6 col-xs-12 xs-device uk-margin-bottom">
                        <div class="book-ui">

                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-5">
                                    <a href=""><img src="{{asset('dist/img/book-cover.png')}}" class="img-responsive img-book" alt=""></a>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-7 uk-margin-top margin-right-mins">
                                    <h5 class="uk-margin-top">أسم الكتاب :  <span class="text-info"> <a
                                                    href="{{url('/books/'.$row->bookid.'/'.slug_title($row->title))}}">{{$row->title}}</a></span></h5>
                                    <h5>أسم المؤلف : <span class="text-info"> <a href="{{url('/single-authors/'.$row->authorid.'/'.slug_title($row->name))}}">{{$row->name}}</a></span></h5>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        @endif
        <div class="text-center">
            <a href="{{action('HomeController@comment',[ 'url' =>'single-authors/'.$author[0]->id.'/'.slug_title($author[0]->name),'type'=>'المؤلف','label'=>$author[0]->name])}}" class="btn btn-primary btn-ms"> أضف تعليق</a>
        </div>
    </div>
@endsection

