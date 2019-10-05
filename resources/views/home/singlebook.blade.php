@extends('home.main')
@section('title')
    : {{$book[0]->title}}
    @endsection
    @section('content')

            <!-- Start of Search Wrapper -->
    <div class="search-area-wrapper">
        <div class="search-area text-center">
            <h2 class="text-primary">ابحث في عناوين الكتاب</h2>
        </div>
        <div class="search-control" id="more-topic">
            <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
            <input type="text" name="saerch-topic" id="title-filter" class="form-control" placeholder="البحث فى عنواين الكتاب">
        </div>

    </div>
    <!-- End of Search Wrapper -->


    <div class="single-book">

        <div class="booksinfo ">
            @foreach($book as $row)
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}" class="white-color">الرئيسية</a></li>
                    <li><a class="white-color" href="{{url('books/'.$row->bookid.'/'.slug_title($row->title))}}">{{$row->title}}</a></li>
                </ol>

                <h3 class="uk-margin-top">أسم الكتاب :  <span class="text-info"> <a
                            href="{{url('/books/'.$row->bookid.'/'.slug_title($row->title))}}">{{$row->title}}</a></span></h3>
                <h4>أسم المؤلف : <span class="text-info"> <a href="{{url('/authors/'.$row->bookid.'/'.slug_title($row->name))}}">{{$row->name}}</a></span></h4>
                <input type="hidden" name="bookid" id="bookid" value="{{$row->bookid}}">

            @endforeach
            <div class="text-center uk-margin-top">
                @if($hadith)
                <a href="{{url('/single-book/'.$row->bookid.'/'.slug_title($row->title)).'/'.$subMore.'/'.$hadith}}" class="btn btn-default btn-read book-comm"> تابع القراءة</a>
                @endif
                <?php
                    if($subject->has(0)){
                        $subId = $subject[0]->id;
                    }else{
                        $subId = 0 ;
                    }

                    ?>
                <a href="{{url('/single-book/'.$row->bookid.'/'.slug_title($row->title)).'/'.$subId}}" class="btn btn-primary btn-ms book-comm"> أقرأ الكتاب</a>
                <a href="{{action('HomeController@comment',[ 'url' =>'single-book/'.$row->bookid.'/'.slug_title($row->title).'/'.$subId,'type'=>'كتاب','label'=> $row->title ])}}" class="btn btn-primary btn-ms book-comm"> أضف تعليق</a>
            </div>

        </div>
        <hr>
        <div class="book-contain">
            <div class="text-center">
                <h2 class="text-info">محتويات الكتاب</h2>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @if($result)

                @foreach($result as $row)
                    @if(count($result) != 1)
                        <div class="panel panel-info ">
                    <div class="panel-heading" role="tab" id="heading{{$row->id}}">
                        <h4 class="panel-title padding-title uk-margin-large-right">
                            <a href="{{url('/single-book/'.$row->bookid.'/'.slug_title($book[0]->title).'/'.$row->id.'/')}}">{{$row->title}}</a>
                        </h4>
                        <a class="pull-left icon-child white-color" id="subtitle" data-id="{{$row->id}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$row->id}}" aria-expanded="true" aria-controls="collapse{{$row->id}}">
                            <i class="fa fa-eercast" aria-hidden="true"></i>
                        </a>

                    </div>
                    <div id="collapse{{$row->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$row->id}}">

                    </div>
                </div>
                    @else
                        <div class="panel panel-info ">
                            <div class="panel-heading" role="tab" id="heading{{$row->id}}">
                                <h4 class="panel-title padding-title uk-margin-large-right">
                                    <a href="{{url('/single-book/'.$row->bookid.'/'.slug_title($book[0]->title).'/'.$row->id.'/')}}">{{$row->title}}</a>
                                </h4>
                                <a class="pull-left icon-child white-color"  data-id="{{$row->id}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$row->id}}" aria-expanded="true" aria-controls="collapse{{$row->id}}">
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                </a>

                            </div>
                            <div id="collapse{{$row->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$row->id}}">
                                @if(!empty($subtitle))
                                    <div class="panel-body">
                                        <div class="list-group">
                                            @foreach($subtitle as $row)
                                                <a class="list-group-item" href="{{url('/single-book/'.$book[0]->bookid.'/'.slug_title($book[0]->title).'/'.$row->id.'/')}}">{{$row->title}}</a>

                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @endif
                @endforeach
                @endif
            </div>
            @if(count($subject)>= 9)
            <div class="loadmore text-center uk-margin-bottom">
                <button class="btn btn-primary btn-more" id="loadtitle" data-id="1" data-counter="{{$counter}}" data-bookid="{{$book[0]->bookid}}">أكثر</button>
            </div>
            @endif

        </div>
    </div>

@endsection

