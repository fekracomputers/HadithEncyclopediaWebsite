@extends('home.main')
@section('description')
    موسوعة الحديث , موضوعات الاحاديث
@endsection
@section('keywords')
    @foreach($category as $row)
        {{$row->title}} ,
    @endforeach
@endsection
@section('title')
        : {{$title}}
        @endsection
@section('content')

        <!-- Start of Search Wrapper -->
        <div class="search-area-wrapper">
    <div class="search-area text-center">
        <h2 class="text-primary">ابحث في الموضوعات</h2>
    </div>
    <div class="search-control" id="more-topic">
        <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
        <input type="text" name="saerch-topic" id="topic-filter" class="form-control" placeholder="البحث فى المواضيع">
    </div>

</div>
        <!-- End of Search Wrapper -->


<div class="categories">
        <div class="text-center">
            <h2 class="text-info margin-bottom">المواضيع</h2>
        </div>
        <div id="topic" class="row uk-margin-top">
            @foreach($category as $row)
                <div class="col-md-4 col-sm-6 col-xs-12 margin-bottom">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 img-index">
                            <img src="{{asset('dist/img/category.png')}}" alt="المواضيع" title="{{$row->title}}" class="img-responsive img-up img-shadow">

                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8 panel-index">
                            <div class="panel panel-default panel-shdow">
                                <div class="panel-body">


                                    <h1 class="margin-right head-font">
                                        <a href="{{url('/topic/'.$row->id.'/'.slug_title($row->title))}}" class="black-color">
                                            {{$row->title}}
                                        </a>
                                    </h1>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    <div class="loadmore text-center uk-margin-bottom">
        <button class="btn btn-default btn-more next" id="loadtopic" data-id="{{$row->id}}">أكثر</button>
    </div>

    </div>
    <!-- end of categories-->
@endsection

