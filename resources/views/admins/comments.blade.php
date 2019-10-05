@extends('admins.main')
@section('content')

    <ol class="breadcrumb newcrumb">
        <li>
            <a href="{{url('/admins')}}">
            <span><i class="fa fontello-home-outline"></i>
            </span>Home</a>
        </li>

        <li class="active">Comments</li>
    </ol>
    <div class="row">
        <div class="">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title text-primary">All Comments</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered table-responsive" id="comments">
                        <thead>
                        <tr>
                            <th style="width:5%">رقم</th>
                            <th style="width:30%">التعليق</th>
                            <th style="width:15%">البريد الألكتروني</th>
                            <th style="width:27%">الرابط</th>
                            <th style="width:10%">الحالة</th>
                            <th style="width:12%">التاريخ</th>
                        </tr>
                        </thead>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- /.box -->
        </div>
    </div>


    <!-- page script -->
    <script>
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "date-uk-pre": function ( a ) {
                if (a == null || a == "") {
                    return 0;
                }
                var ukDatea = a.split('/');
                return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
            },

            "date-uk-asc": function ( a, b ) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },

            "date-uk-desc": function ( a, b ) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        } );
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
                    {data: 'date', name: 'date'  },
                ],
                columnDefs: [
                    { type: 'date-uk', targets: 0 }
                ]


            } );
        } );
    </script>

    @endsection
