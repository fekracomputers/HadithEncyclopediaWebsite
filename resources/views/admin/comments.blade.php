@extends('admin.main')
@section('content')

<div class="row-fluid">

    <div class="span12">
        @if(Session::has('comment'))
            <div class="alert alert-success">
                <p>{!! Session::get('comment') !!}</p>
            </div>
        @endif
        <div class="widget no-margin">
            <div class="widget-header">
                <div class="title">
                    <span class="fs1" aria-hidden="true" data-icon="&#xe14a;"></span> Dynamic Table
                </div>
            </div>
            <div class="widget-body">
                <div id="dt_example" class="example_alt_pagination">
                    <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="comments">
                        <thead>
                        <tr>
                            <th style="width:5%">id</th>
                            <th style="width:30%">Comment</th>
                            <th style="width:15%">email</th>
                            <th style="width:25%">url</th>
                            <th style="width:10%">status</th>
                            <th style="width:15%">date</th>
                        </tr>
                        </thead>
                    </table>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#comments').DataTable( {
                processing: true,
                serverSide: true,
                responsive: true,
                stateSave:true,
                ajax: '{{url('/loadComment')}}',
                columns: [
                    { data: 'id', name: 'id' },
                    {data: 'comment', name: 'comment' },
                    {data: 'email', name: 'email' },
                    {data: 'url', name: 'url'},
                    {data: 'status', name: 'status'},
                    {data: 'date', name: 'date'},
                    ]

            } );
        } );
    </script>
    @endsection