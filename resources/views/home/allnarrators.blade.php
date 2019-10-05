@extends('home.main')
@section('description')
    موسوعة الحديث احاديث , رواة الأحاديث
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
            <h2 class="text-primary">ابحث في الرواة</h2>
        </div>
        <div class="search-control" id="narratorsdom">
            <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
            <div class="form-inline">
                <input type="text" name="saerch-topic" id="rawy-filter" class="form-control" placeholder="البحث فى الرواة">
                <select name="rotba" id="rotba" class="form-control">
                    <option value="0">الجميع</option>
                    <option value="صحابي">صحابي</option>
                    <option value="ثقة">ثقة</option>
                    <option value="صدوق">صدوق</option>
                    <option value="حسن">حسن الحديث</option>
                    <option value="فقيه">فقيه</option>
                    <option value="مقبول">مقبول</option>
                    <option value="مجهول">مجهول</option>
                    <option value="ضعيف">ضعيف</option>
                    <option value="بالكذب">متهم بالكذب</option>
                    <option value="كذاب">كذاب</option>
                    <option value="بالوضع">متهم بالوضع</option>
                    <option value="متروك">متروك الحديث</option>
                    <option value="منكر">منكر الحديث</option>

                </select>
            </div>


        </div>

    </div>
    <!-- End of Search Wrapper -->


    <div class="author-panel">
        <div class="text-center uk-margin-top">
            <h2 class="text-info">الرواة</h2>
        </div>
        <div id="narratorid" class="row uk-margin-large-top">
            @foreach($result as $row)
                <div class="col-md-4 col-sm-6 col-xs-12 xs-device text-center uk-margin-bottom">
                    <div class="panel panel-default height-narrator">
                        <div class="panel-body">
                            @if(trim($row->gender) == 'رجل')
                            <img src="{{asset('dist/img/man-vector.png')}}" class="img-up" alt="الراوي" title="{{$row->name}}">
                            @else
                                <img src="{{asset('dist/img/women-vector.png')}}" class="img-up" alt="الراوي" title="{{$row->name}}">
                            @endif
                                <h1 class="text-info head-font"><a href="{{url('/narrators/'.$row->id.'/'.slug_title($row->name))}}">{{str_limit($row->name,30)}}</a> </h1>
                        </div>
                        <div class="panel-heading head-height">
                            @if($row->lakab !='')<p> <span class="text-info">اللقب :</span> {{$row->lakab}} </p>@endif
                            <p> <span class="text-info">الرتبة :</span> {{$row->rotba}} </p>
                            <p>
                                @if($row->higribirthyear != '0')<span class="text-info">ولد عام :</span> {{$row->higribirthyear}} ,@endif
                                @if($row->higrideathyear != '0') <span class="text-info">توفي عام :</span>  <span> {{$row->higrideathyear}}</span></p>@endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="loadmore text-center uk-margin-bottom">
            <button class="btn btn-default btn-more next" id="loadnarrators" data-id="{{$row->id}}">أكثر</button>
        </div>

        <div class="loadmore text-center uk-margin-bottom">

            <button class="btn btn-default btn-more next"  id="loadMoreNarr"  data-id="1">أكثر</button>
        </div>
    </div>
    <!-- end of Authors-->
@endsection

