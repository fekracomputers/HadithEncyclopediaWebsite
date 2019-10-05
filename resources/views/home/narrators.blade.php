@extends('home.main')
@section('title')
    : {{$narrator->name}}
@endsection
@section('content')

<div>
    <img src="{{asset('dist/img/bannar.png')}}" alt="bannar" title="الرواة" class="img-bannar">
</div>    <!--end slideshow -->


<div class="single-book">
    <div class="book-contain">
        <div class="text-center uk-margin-large-bottom">
            <h2 class="text-info">معلومات عن الراوي</h2>
        </div>
        <div class="panel-group uk-margin-top" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title text-primary">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                عن حياة الراوي
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <h5> الأسم <span class="text-info"> : {{$narrator->name}}</span></h5>
                        <h5>  الشهرة<span class="text-info"> : {{$narrator->shohra}}</span>
                            @if($narrator->konia !='') , الكنيه: <span class="text-info">{{$narrator->konia}}</span> @endif
                        </h5>
                        @if($narrator->nassab !='')
                        <h5>النسب : <span class="text-info"> {{$narrator->nassab}}</span></h5>
                        @endif
                        @if($narrator->rotba !='')
                        <h5>الرتبة : <span class="text-info"> {{$narrator->rotba}}</span></h5>
                        @endif
                        @if($narrator->liveat !='')
                        <h5>عاش في : <span class="text-info"> {{$narrator->liveat}}</span></h5>
                        @endif
                        @if($narrator->deadat !='')
                            <h5>مات في : <span class="text-info"> {{$narrator->deadat}}</span></h5>
                        @endif
                        @if($narrator->job !='')
                        <h5>الوظيفة : <span class="text-info"> {{$narrator->job}}</span></h5>
                            @endif
                        @if($narrator->mawaly !='')
                            <h5>مولي : <span class="text-info"> {{$narrator->mawaly}}</span></h5>
                        @endif
                        @if($narrator->higribirthyear !=0)
                            <h5>ولد عام : <span class="text-info"> {{$narrator->higribirthyear}}</span></h5>
                        @endif
                        @if($narrator->higrideathyear !=0)
                            <h5>توفي عام : <span class="text-info"> {{$narrator->higrideathyear}}</span></h5>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        تلاميذ الراوي
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>الأسم</td>
                                <td class="hidden-xs">الشهرة</td>
                                <td>الرتبة</td>
                            </tr>
                            @foreach($student as $row)
                                <tr>
                                    <td>
                                        <a class="effect" data-id="{{$row->narratorid}}" href="{{url('narrators/'.$row->narratorid.'/'.slug_title(str_limit($row->name,30)))}}">
                                            {{str_limit($row->name,40)}}
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


                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading3">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapseTwo">
                        أساتذة الراوي
                        </a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>الأسم</td>
                                <td class="hidden-xs">الشهرة</td>
                                <td>الرتبة</td>
                            </tr>
                            @foreach($teacher as $row)
                                <tr>
                                    <td>
                                        <a class="effect" data-id="{{$row->narratorid}}" href="{{url('narrators/'.$row->narratorid.'/'.slug_title(str_limit($row->name,30)))}}">
                                            {{str_limit($row->name,40)}}
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
                    </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading4">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapseTwo">
  الجرح والتعديل
                        </a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            @foreach($jerh as $row)
                            <li>
                                <h5>{{$row->name}}   :
                                    <span class="text-info">
                                        {{$row->opinion}}
                                    </span>
                                </h5>
                            </li>
                             @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="text-center">
        <a href="{{action('HomeController@comment',[ 'url' =>'narrators/'.$narrator->id.'/'.slug_title(str_limit($narrator->name,30)),'type'=>'الراوي','label'=> str_limit($narrator->name,30)])}}" class="btn btn-primary btn-ms"> أضف تعليق</a>
        <a href="{{url('narrators-hadith/'.$narrator->id.'/'.slug_title(str_limit($narrator->name,30)))}}" class="btn btn-primary btn-ms"> أحاديث الراوي</a>

    </div>
</div>

@endsection

