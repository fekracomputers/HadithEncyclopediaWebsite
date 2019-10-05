@extends('admins.main')
@section('content')

    <div class="row-fluid">
        <div class="span12">
        <div class="widget no-margin">
        <div class="widget-header">
            <div class="title">
                <span class="fs1" aria-hidden="true" data-icon="&#xe14a;"></span> Comment Issuse
            </div>
        </div>
        <div class="widget-body">
            <div class="panel panel-primary">
<h5><span class="text-info">Email</span> :{{$comm->email}}</h5>
<h5><span class="text-info">Status</span> :{{$comm->status}}</h5>
<h5><span class="text-info">url :</span>
 <a href="{{url($comm->url)}}">{{$comm->type .' - '. $comm->label}}</a>
</h5>
 <h5><span class="text-info">Date </span> :
                    <?php $ex = explode(' ',$comm->created_at);   echo $ex[0] ;?>
 </h5>
                <h4 class="more-height">
                    <span class="text-info">Comment From User :</span>
                </h4>

                <div class="panel-comm">

                    <p>
                        {{$comm->comment}}
                    </p>
                </div>
                <hr>
            </div>
                    @if(!$feed)
                    <form action="{{url('sendissus')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="form-group">
                            <div class="row-fluid">
                                <div class="span8 margin-left">
                                    <textarea name="comment" class="form-control" cols="20" rows="6"></textarea>
                                </div>
                                <div class="span2">
                                    <button type="submit" class="btn btn-default btn-large pull-left btn-sub">Resolved</button>
                                </div>

                            </div>
                        </div>
                        <br>


                        <br>
                    </form>
                        @else
                        <h2 class="red-resolve">Solved</h2>
                <h5><span class="text-info">Date</span> :{{$comm->created_at}}</h5>

                <div class="form-group panel-comm">
                 <h3>   {{$feed->feed}}</h3>
                 </div>
                    @endif
                </div>
        </div>
        </div>
    </div>
@endsection
