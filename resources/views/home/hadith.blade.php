@extends('home.main')
@section('description')
    موسوعة الحديث ,أحاديث كتاب {{$book->title}}
@endsection
@section('keywords')
    {{str_limit($hadith->body,150)}}
@endsection
@section('description')
    {{$hadith->body}}
@endsection
@section('title')
    : {{$book->title}} : {{$hadith->id}}
    @endsection
    @section('content')

        <!--end slideshow -->

        <div class="hadith-panel">
            <div class="panel-body mini-xs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}" class="white-color">الرئيسية</a></li>
                    <li><a class="white-color" href="{{url('books/'.$bookid.'/'.slug_title($book->title))}}">{{$book->title}}</a></li>
                    @if($subjects != '')
                    <li class="active">{{$subjects->title}}</li>
                        @endif
                </ol>
                <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">

                <div class="row uk-margin-large-bottom mini-xs">
                    <div class="col-md-1 col-sm-1 hidden-xs uk-position-z-index">
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <div class="text-center">
                            @if($subjects != '')
                            <h2 class="text-info md-text">{{str_limit($subjects->title,85)}}</h2>
                            @endif

                        </div>
                        <br>
                        <div class="hadith-box">
                            <div class="title-subject">
                                <div class="row">
                                    <div class="col-md-4 col-xs-5 padding-remove">
                                        <a href="#" data-toggle="modal" data-target="#myModal">
                                            <img src="{{asset('dist/img/book-open-flat.png')}}" alt="تفسير" class="img-tef">
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row" id="test">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="text-primary uk-margin-right" > رقم الحديث :
                                            <span id="hadithid" data-slug="{{slug_title($book->title)}}" data-book="{{$book->id}}" data-id="{{$hadith->id}}"> {{$hadith->id}} </span>   </h4>
                                    </div>
                                    <div class="col-md-8 col-xs-7 ">
                                        <div class="pull-right">
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$first_subject->subjectid.'/'.($first->id).'')}}"
                                               data-uk-tooltip title=" {{'('.$first->id.') الحديث الأول' }}"
                                               class="btn btn-default command nav-icon uk-margin-left">
                                                <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            </a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$subjectid.'/'.($hadith->id-1).'')}}"
                                               data-uk-tooltip title="السابق ({{$hadith->id-1}})" data-title="{{$book->title}}" id="data-prev" data-hadith="{{$hadith->id}}" data-slug="{{slug_title($book->title)}}" data-subject="{{$subjectid}}" data-id="{{$hadith->id}}" data-book="{{$hadith->bookid}}"
                                               class="btn btn-default nav-icon">
                                                <i class="fa fa-angle-double-right"></i></a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$subjectid.'/'.($hadith->id+1).'')}}"
                                               data-uk-tooltip title=" التالي ({{$hadith->id+1}})" data-title="{{$book->title}}" data-hadith="{{$hadith->id}}" data-slug="{{slug_title($book->title)}}" id="data-next" data-subject="{{$subjectid}}" data-id="{{$hadith->id}}" data-book="{{$hadith->bookid}}"
                                               class="btn btn-default nav-icon ">
                                                <i class="fa fa-angle-double-left "></i></a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$last_subject->subjectid.'/'.($last->id).'')}}"
                                               data-uk-tooltip title="{{'('.$last->id.') الحديث الأخير'}}" data-title="{{$book->title}}"
                                               class="btn btn-default command nav-icon uk-margin-right">
                                                <span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <p class="more-height">
                                    {!! html_entity_decode($hadith->body)!!}
                                </p>

                            </div>
                            <div class="title-subject">
                                <div class="row">
                                    <div class="col-xs-4 padding-remove">
                                        <h4 class="text-primary uk-margin-right">الرواه :  </h4>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="pull-right">
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$first_subject->subjectid.'/'.($first->id).'')}}"
                                               data-uk-tooltip title=" {{'('.$first->id.') الحديث الأول' }}"
                                               class="btn btn-default command nav-icon uk-margin-left">
                                                <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            </a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$subjectid.'/'.($hadith->id-1).'')}}"
                                               data-uk-tooltip title="السابق ({{$hadith->id-1}})" data-title="{{$book->title}}" id="data-prev" data-hadith="{{$hadith->id}}" data-slug="{{slug_title($book->title)}}" data-subject="{{$subjectid}}" data-id="{{$hadith->id}}" data-book="{{$hadith->bookid}}"
                                               class="btn btn-default nav-icon">
                                                <i class="fa fa-angle-double-right"></i></a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$subjectid.'/'.($hadith->id+1).'')}}"
                                               data-uk-tooltip title=" التالي ({{$hadith->id+1}})" data-title="{{$book->title}}" data-hadith="{{$hadith->id}}" data-slug="{{slug_title($book->title)}}" id="data-next" data-subject="{{$subjectid}}" data-id="{{$hadith->id}}" data-book="{{$hadith->bookid}}"
                                               class="btn btn-default nav-icon ">
                                                <i class="fa fa-angle-double-left "></i></a>
                                            <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$last_subject->subjectid.'/'.($last->id).'')}}"
                                               data-uk-tooltip title="{{'('.$last->id.') الحديث الأخير'}}" data-title="{{$book->title}}"
                                               class="btn btn-default command nav-icon uk-margin-right">
                                                <span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="rawy-bottom">
                                <table class="table table-striped">
                                    <tr>
                                        <td>الأسم</td>
                                        <td class="hidden-xs">الشهرة</td>
                                        <td>الرتبة</td>
                                    </tr>
                                    @foreach($narrators as $row)
                                        <tr>
                                            <td>
                                                <a class="effect" data-rotba="{{color_send($row->rotba)}}" data-id="{{$row->narratorid}}" href="{{url('narrators/'.$row->narratorid.'/'.slug_title(str_limit($row->name,30)))}}">
                                                    {{$row->narratorname}}
                                                </a>
                                            </td>
                                            <td class="hidden-xs">@if($row->shohra !='') {{ $row->shohra}} @endif
                                                @if($row->higribirthyear != 0) <span class="text-info"> / ولد في :</span>{{ $row->higribirthyear}} @endif
                                                @if($row->higrideathyear != 0)  <span class="text-info"> / توفي في :</span>{{ $row->higrideathyear}} @endif
                                            </td>
                                            <td><p style="font-weight:bold ;color: {{color_send($row->rotba)}} !important;
                                                @if(str_is($row->rotba , 'صحابي*'))
                                                        background:#fff;
                                                        color: #000 !important;
                                                @endif">{{$row->rotba}}</p></td>
                                        </tr>
                                    @endforeach
                                </table>
                                <p>

                            </div>

                        </div>


                    </div>
                    <div class="col-md-1 col-sm-1 hidden-xs">

                    </div>

                </div>
                <div class="text-center">
                    <a id="comment" href="{{action('HomeController@comment',[ 'url' =>'single-book/'.$book->id.'/'.slug_title($book->title).'/'.$subjectid.'/'.$hadith->id,'type'=>'حديث','label'=> $book->title .' - '.$hadith->id])}}" class="btn btn-primary btn-ms"> أضف تعليق</a>

                </div>

            </div>
        </div>
@endsection

