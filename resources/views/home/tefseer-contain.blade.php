<style>
    .hadith-box p{
        font-size: 18px;
        line-height: 2.3;
        text-align: justify;
    }
</style>
<div class="panel-body mini-xs">
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}" class="white-color">الرئيسية</a></li>
        <li><a class="white-color" href="#">{{$book['title']}}</a></li>
    </ol>
    <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">

    <div class="row uk-margin-large-bottom mini-xs">
        <div class="col-md-1 col-sm-1 hidden-xs uk-position-z-index">
        </div>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <div class="hadith-box">
                <div class="title-subject">
                    <div class="row">
                        <div class="col-md-4 col-xs-5 padding-remove">
                            <h4 class="text-primary uk-margin-right" > رقم الحديث :
                                <span id="hadithtef" data-book="{{$bookid}}" data-id="{{$hadithid}}"> {{$hadithid}} </span>   </h4>
                        </div>
                        <div class="col-md-8 col-xs-7 ">
                            <div class="pull-right">
                                <button data-uk-tooltip id="tefser-first" title="{{'('.$hadith['firstpagenumber'].') الحديث الأول' }}"
                                        data-id="{{$hadith['firstpagenumber']}}" data-book="{{$bookid}}"
                                        class="btn btn-default nav-icon">
                                    <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                </button>
                                <button   data-uk-tooltip title="السابق ({{$hadithid-1}})" data-title="{{$book['title']}}" id="tefser-prev" data-hadith="{{$hadithid}}" data-slug="{{slug_title($book['title'])}}"  data-id="{{$hadithid}}" data-book="{{$bookid}}"
                                          class="btn btn-default nav-icon">
                                    <i class="fa fa-angle-double-right"></i>
                                </button>
                                <button   data-uk-tooltip title="التالي ({{$hadithid+1}})" data-title="{{$book['title']}}" id="tefser-next" data-hadith="{{$hadithid}}" data-slug="{{slug_title($book['title'])}}"  data-id="{{$hadithid}}" data-book="{{$bookid}}"
                                          class="btn btn-default nav-icon">
                                    <i class="fa fa-angle-double-left "></i></a>
                                </button>
                                <button data-uk-tooltip title="{{'('.$hadith['lastpagenumber'].') الحديث الأخير' }}"
                                        data-id="{{$hadith['lastpagenumber']}}" data-book="{{$bookid}}"
                                        id="tefser-last" class="btn btn-default nav-icon">
                                    <span><i class="fa fa-chevron-left" aria-hidden="true"></i></span></a>
                                </button>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <p class="more-height">
                        {!! html_entity_decode($hadith['page'])!!}
                    </p>

                </div>

            </div>


        </div>

    </div>

</div>
