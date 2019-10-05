@foreach($final as $row)
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info height-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="{{url('/books/'.$row["bookid"].'/'.slug_title($row['title']))}}">{{$row['title']}} - </a>
                                <span>
                                    رقم الحديث : {{$row['hadithid']}}
                                </span>
                </h4>
            </div>
            <div class="panel-body">
                <p class="more-height">{{$row['content']}}</p>
                <p class="pull-right uk-margin-bottom">
                    <a href="
                                {{url('single-book/'.$row['bookid'].'/'.slug_title($row['title']).'/'.
                                $row['subid'].'/'.$row['hadithid'])}}" class="btn btn-primary btn-pos">
                        أقرأ الحديث</a></p>
            </div>

        </div>
    </div>
@endforeach
