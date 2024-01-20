@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.timeslots"))
@section('content')

    <div class="">
        @component('component.heading' , [
            'page_title' => __("t.timeslots"),
            'action' => route('timeslots.create') ,
            'text' => __("t.add_time_slot"),
            'permission' => 1,
        ])
        @endcomponent

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="timeSlotsTable" class="table">
                            <thead>
                                <tr>
                                    <th>{{__("t.lawer")}}</th>
                                    <th>{{__("t.date")}}</th>
                                    <th>{{__("t.start_date")}}</th>
                                    <th>{{__("t.end_date")}}</th>
                                    <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeslots as $timeslot)
                                    <tr>
                                        <td>{{ $timeslot->first_name.' '.$timeslot->last_name }}</td>
                                        <td>{{ $timeslot->date }}</td>
                                        <td>{{ $timeslot->start_time }}</td>
                                        <td>{{ $timeslot->end_time }}</td>
                                        <td>
                                            <a target="/admin/timeslots/{{ $timeslot->tsid }}" class="red genDeleteBtn" data-toggle="modal" data-target="#gendeleteModal"><i class="fa fa-trash"></i></a>
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
    $('#timeSlotsTable').DataTable({
        columnDefs: [
            {
                targets: 4,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>
