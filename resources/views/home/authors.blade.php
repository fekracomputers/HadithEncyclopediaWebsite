@extends('home.main')
@section('description')
    موسوعة الحديث احاديث , مؤلفين الكتب
@endsection
@section('keywords')
    موسوعة الحديث,أحاديث صحيحة,رواة الاحاديث , موضوعات الاحاديث , كتب الاحاديث
@endsection
@section('title')
    : {{$title}}
    @endsection
    @section('content')

            <!-- Start of Search Wrapper -->
    <div class="search-area-wrapper">
        <div class="search-area text-center">
            <h2 class="text-primary">ابحث في المؤلفين</h2>
        </div>
        <div class="search-control" id="more-topic">
            <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
            <input type="text" name="saerch-topic" id="author-filter" class="form-control" placeholder="البحث فى المؤلفين">
        </div>

    </div>
    <!-- End of Search Wrapper -->


    <div class="author-panel">
        <div class="text-center uk-margin-top">
            <h2 class="text-info">المؤلفين</h2>
        </div>
        <div id="authors" class="row uk-margin-large-top">
            @foreach($author as $row)
                <div class="col-md-4 col-sm-6 col-xs-12 xs-device text-center uk-margin-bottom">
                    <div class="panel panel-default height-author">
                        <div class="panel-body">
                        <img src="{{asset('dist/img/author.png')}}" class="img-up" alt="المؤلف" title="{{$row->name}}">
                    <h1 class="text-info uk-margin-top-remove head-font"><a href="{{url('/single-authors/'.$row->id.'/'.slug_title($row->name))}}">{{$row->name}}</a> </h1>
                       </div>
                    </div>
                </div>
            @endforeach
        </div>

            <div class="loadmore text-center uk-margin-bottom">
                <button class="btn btn-default btn-more next" id="loadauthor" data-id="{{$row->id}}">أكثر</button>
            </div>

    </div>
    <!-- end of Authors-->
@endsection

