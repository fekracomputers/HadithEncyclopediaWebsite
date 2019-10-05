@foreach($result as $row)
    <div class="panel panel-info ">
        <div class="panel-heading" role="tab" id="heading{{$row->id}}">
            <h4 class="panel-title padding-title uk-margin-large-right">
                <a href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$row->id.'/')}}">{{$row->title}}</a>
            </h4>
            <a class="pull-left icon-child white-color" id="subtitle" data-id="{{$row->id}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$row->id}}" aria-expanded="true" aria-controls="collapse{{$row->id}}">
                <i class="fa fa-eercast" aria-hidden="true"></i>
            </a>

        </div>
        <div id="collapse{{$row->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$row->id}}">
        </div>
    </div>
@endforeach
