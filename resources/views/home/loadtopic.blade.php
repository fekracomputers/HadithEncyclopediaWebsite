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

