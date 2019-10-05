@if(!empty($subject))
<div class="panel-body">
    <div class="list-group">
        @foreach($subject as $row)
            <a class="list-group-item" href="{{url('/single-book/'.$book->id.'/'.slug_title($book->title).'/'.$row->id.'/')}}">{{$row->title}}</a>

        @endforeach
    </div>
</div>
    @else
    <div class="panel-body">
        <h5>لا يوجد عناوين فرعية</h5>
    </div>

    @endif

