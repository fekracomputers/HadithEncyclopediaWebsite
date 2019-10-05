@extends('home.main')
@section('title')
    : {{$title}}
    @endsection
    @section('content')

        <div>
            <img src="{{asset('dist/img/bannar.png')}}" alt="bannar" title="الرواة" class="img-bannar">
        </div>           <!--end slideshow -->


    <div class="books">
        <div class="uk-margin-large-top">
            <div class="alert alert-info">
                <p class="white-color">عند قراءة أي كتاب يتم حفظه بواسطة Cookies</p>
            </div>
            <h2 class="text-info">الكتب التى تم قرائتها </h2>
        </div>
        <br>
        @if(!empty($book))
        <div id="books" class="row uk-margin-top">
            @foreach($book as $row)
                <div id="cookie{{$row->bookid}}" class="col-md-4 col-sm-6 col-xs-12 xs-device uk-margin-bottom">
                    <a href="" class="uk-button uk-button-danger close-cookie" data-id="{{$row->bookid}}">
                        <i class="uk-icon-close"></i>
                    </a>

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
            @else
            <div class="alert alert-warning">
                <p>لا يوجد كتب قمت بقرائتها من قبل</p>
            </div>
        @endif
        <div class="text-center margin-top">
            <a href="{{action('HomeController@comment',[ 'url' =>'mybook','type=mybook' ,'label'=>'كتبي'])}}" class="btn btn-primary btn-ms"> أضف تعليق</a>
        </div>
    </div>
    <br><br>
    <br><br>
@endsection

