@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.time_lows"))
@section('content')

    <div class="">
        @component('component.heading' , [
            'page_title' => __("t.time_lows"),
            'action' => '/admin/judge-time-low/create' ,
            'text' => __("t.add_time_low"),
            'permission' => 1,
        ])
        @endcomponent
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th>{{__("t.number_days")}}</th>
                                    <th>{{__("t.case_level")}}</th>
                                    <th>{{__("t.case_type")}}</th>
                                    <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($times as $time)
                                    <tr>
                                        <td>{{ $time->number_days }}</td>
                                        <td>{{ __("t.".$time->case_level) }}</td>
                                        <td>{{ $time->case_type_name }}</td>
                                        <td>
                                            <a target="/admin/judge-time-low/{{ $time->jtlid }}" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#slidersTable').DataTable({
        columnDefs: [
            {
                targets: 2,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>
