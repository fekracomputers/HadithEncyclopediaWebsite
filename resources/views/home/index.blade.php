@extends('home.main')
@section('description')
    موسوعة الحديث تضم كل كتب الحديث من صحيح البخاري و مسلم و سنن الترمذي و النسائي و ابي داود و ابن ماجه و مسند احمد و موطأ مالك و سنن الدارمي
@endsection
@section('keywords')
    موسوعة الحديث - أحاديث صحيحة - رواة الاحاديث - موضوعات الاحاديث - كتب الاحاديث
@endsection
@section('content')
    <div class="slideshow-container">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{asset('dist/img/slide-4.jpg')}}" alt="slide-1" title="المسجد النبوي" class="img-slider">
                </div>
                <div class="item">
                    <img src="{{asset('dist/img/slide-3.jpg')}}" alt="slide-2" title="مكة" class="img-slider">
                </div>
                <div class="item">
                    <img src="{{asset('dist/img/slide-2.jpg')}}" alt="slide-3" title="المسجد الحرام" class="img-slider">
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--end slideshow -->

    <div class="panel-body text-center">
        <div class="col-md-4 col-sm-6">
            <img src="{{asset('dist/img/books.png')}}" alt="الكتب" title="الكتب" class="img-responsive img-up">
            <h3 class="text-info">المئات من الكتب</h3>
            <p>"الكتب والمواضيع" لدينا {{$num_book}} كتاب مقسمة إلى {{$num_topic}} موضوع </p>
        </div>
        <div class="col-md-4 col-sm-6">
            <img src="{{asset('dist/img/author.png')}}" alt="المؤلفين" title="المؤلفين" class="img-responsive img-up">
            <h3 class="text-info">المئات من المؤلفين</h3>
            <p>"المؤلفين والرواة" لدينا لدينا {{$num_author}} مؤلف وجامع للاحاديث الصحيحة و {{$num_narrators}} الف راوي مع بيانات مفصله</p>

        </div>
        <div class="col-md-4 col-sm-12">
            <img src="{{asset('dist/img/category.png')}}" alt="الموضوعات" title="الموضوعات" class="img-responsive img-up">
            <h3 class="text-info">مواضيع كثيرة</h3>
            <p>"الأحاديث" لدينا {{$num_Hadith}} الف حديث مخرج ومفهرس في {{$num_subject}} الف موضوع. لدينا أكثر من 40 ألف حديث مشروح.</p>
        </div>

    </div>
<!--end public group-->

<div class="categories">
    <div class="text-center">
        <h2 class="text-info margin-bottom">المواضيع</h2>
    </div>
    <div class="uk-margin-top">
        @foreach($category as $row)
            <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4 img-index">
                        <img src="{{asset('dist/img/category.png')}}" alt="الموضوعات" title="{{$row->title}}" class="img-responsive img-up img-shadow">

                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8 panel-index">
                        <div class="panel panel-default panel-shdow">
                            <div class="panel-body">


                                <h4 class="margin-right">
                                    <a href="{{url('/topic/'.$row->id.'/'.slug_title($row->title))}}" class="black-color">
                                       {{$row->title}}
                                    </a>
                                </h4>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
    </div>
    <div class="text-center uk-margin-top uk-margin-bottom">
        <a href="{{url('/topic')}}" class="btn btn-primary btn-ms">المزيد من المواضيع</a>
    </div>

</div>
<!-- end of categories-->

<div class="books">
    <div class="text-center">
        <h2 class=""> الكتب </h2>
    </div>
    <div class="uk-margin-top">
        @foreach($book as $row)
        <div class="col-md-4 col-sm-6 col-xs-12 xs-device uk-margin-bottom">
            <div class="book-ui">

                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-5">
                        <a href=""><img src="{{asset('dist/img/book-cover.png')}}" class="img-responsive img-book" alt="الكتب" title="{{$row->title}}"></a>
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
    <div class="uk-margin-top text-center uk-margin-bottom">
        <a href="{{url('/all-books')}}" class="btn btn-primary btn-ms">المزيد من الكتب</a>
    </div>

</div>
<!--end of books-->

<div class="authors">
    <div class="text-center uk-margin-top">
        <h2 class="text-info">المؤلفين</h2>
    </div>
    <div class="uk-margin-large-top">
        @foreach($author as $row)
        <div class="col-md-4 col-sm-6 col-xs-12 xs-device text-center uk-margin-bottom">
            <img src="{{asset('dist/img/author.png')}}" class="img-up" alt="المؤلفين" title="{{$row->name}}">
            <h4 class="text-info uk-margin-top-remove"><a href="{{url('/single-authors/'.$row->id.'/'.slug_title($row->name))}}">{{$row->name}}</a> </h4>
        </div>
            @endforeach
    </div>
    <div class="uk-margin-top text-center uk-margin-bottom">
        <a href="{{url('/authors')}}" class="btn btn-primary btn-ms">المزيد من المؤلفين</a>
    </div>

</div>
<!--end of authors-->
    @endsection