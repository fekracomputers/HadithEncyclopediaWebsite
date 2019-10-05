@extends('home.main')
@section('description')
    {{$title}}موسوعة الحديث كتب عن
@endsection
@section('keywords')
    {{$title}}
@endsection
@section('title')
     {{$title}} ,
    @foreach($book as $row)
            {{$row->title}} ,
    @endforeach
@endsection
    @section('content')

            <!-- Start of Search Wrapper -->
    <div class="search-area-wrapper">
        <div class="search-area text-center">
            <h2 class="text-primary">ابحث في الكتب</h2>
        </div>
        <div class="search-control" id="more-topic">
            <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
            <input type="hidden" name="catid" id="catid" value="{{$catid}}">
            <input type="text" name="saerch-topic" id="single-filter" class="form-control" placeholder="البحث فى الكتب">
        </div>

    </div>
    <!-- End of Search Wrapper -->


    <div class="books">
        <div id="books" class="row uk-margin-top">
            @foreach($book as $row)
                <div class="col-md-4 col-sm-6 col-xs-12 xs-device uk-margin-bottom">
                    <div class="book-ui">

                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-5">
                                <a href=""><img src="{{asset('dist/img/book-cover.png')}}" class="img-responsive img-book" alt="كتاب" title="{{$row->title}}"></a>
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
        <div class="loadmore text-center uk-margin-bottom">
            <button class="btn btn-default btn-more next" id="loadbook" data-page='1' data-id="{{$row->bookid}}">أكثر</button>
        </div>

    </div>

@endsection

