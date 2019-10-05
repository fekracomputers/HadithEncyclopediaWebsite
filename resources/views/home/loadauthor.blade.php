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




