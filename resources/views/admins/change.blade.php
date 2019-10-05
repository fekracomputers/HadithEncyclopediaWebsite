@extends('admins.main')
@section('content')

    <div class="row">

            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title text-primary">User Information</h2>
                </div>
                <div class="box-body">
                    <table class="table ">
                        <tr>
                            <td style="width:8%">
                                <h5><span class="text-info">Email</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5>{{$comm->email}}</h5></td>
                        </tr>
                        <tr>
                            <td style="width:8%">
                                <h5><span class="text-info">Status</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5>{{$comm->status}}</h5></td>
                        </tr>
                        <tr style="width:8%">
                            <td>
                                <h5><span class="text-info">url</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5><a href="{{url($comm->url)}}">{{$comm->type .' - '. $comm->label}}</a></h5></td>
                        </tr>
                        <tr style="width:8%">
                            <td>
                                <h5><span class="text-info">Date</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5><?php $ex = explode(' ',$comm->created_at);   echo $ex[0] ;?></h5></td>
                        </tr>
                    </table>

                </div>
            </div>
        <div class="box box-primary">
            <div class="box-header">
                <h2 class="box-title text-primary">Comment From User </h2>
            </div>
            <div class="box-body">

                    <h5 class="text-comment">
                        {!! nl2br(e($comm->comment)) !!}
                    </h5>

            </div>
        </div>
        <div class="box box-warning">
            <div class="box title text-primary">
                <div class="box-header">
                    @if($feed)
                        <h2 class="box-title text-primary">Solved </h2>
                        @else
                        <h2 class="box-title text-primary">Resolve The issues </h2>

                    @endif
                </div>

            </div>
            <div class="box-body">
                @if(!$feed)
                    <form action="{{url('sendissus')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="form-group">
                                <div class="span8 margin-left">
                                    <textarea name="comment" class="form-control" cols="20" rows="6"></textarea>
                                </div>
                            <br>

                            <div class="span2">
                                    <button type="submit" class="btn btn-primary btn-lg pull-right ">Resolve</button>
                                </div>

                        </div>


                        <br>
                    </form>
                @else
                    <table class="table ">
                        <tr>
                            <td style="width:8%">
                                <h5><span class="text-info">Date</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5><?php $ex = explode(' ',$feed->created_at);   echo $ex[0] ;?></h5></td>
                        </tr>
                        <tr>
                            <td style="width:8%">
                                <h5><span class="text-info">Comment</span></h5>
                            </td>
                            <td> <h5> : </h5></td>
                            <td><h5 class="text-comment">{!! nl2br(e($feed->feed)) !!}</h5></td>
                        </tr>
                    </table>


                @endif
            </div>
        </div>



                </div>
@endsection
