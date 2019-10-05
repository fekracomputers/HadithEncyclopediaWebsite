@foreach($result as $row)
    <div class="col-md-4 col-sm-6 col-xs-12 xs-device text-center uk-margin-bottom">
        <div class="panel panel-default height-narrator">
            <div class="panel-body">
                @if(trim($row['gender']) == 'رجل')
                    <img src="{{asset('dist/img/man-vector.png')}}" class="img-up" alt="الراوي" title="{{$row['name']}}">
                @else
                    <img src="{{asset('dist/img/women-vector.png')}}" class="img-up" alt="الراوي" title="{{$row['name']}}">
                @endif
                <h1 class="text-info head-font"><a href="{{url('/narrators/'.$row['id'].'/'.slug_title($row['name']))}}">{{str_limit($row['name'],30)}}</a> </h1>
            </div>
            <div class="panel-heading head-height">
                @if($row['lakab'] !='')<p> <span class="text-info">اللقب :</span> {{$row['lakab']}} </p>@endif
                <p> <span class="text-info">الرتبة :</span> {{$row['rotba']}} </p>
                <p>
                    @if($row['higribirthyear'] != '0')<span class="text-info">ولد عام :</span> {{$row['higribirthyear']}} ,@endif
                    @if($row['higrideathyear'] != '0') <span class="text-info">توفي عام :</span>  <span> {{$row['higrideathyear']}}</span></p>@endif
            </div>
        </div>
    </div>
@endforeach
<span id="counter" data-counter="{{$counter}}"></span>
<span id="page" data-page="1"></span>
