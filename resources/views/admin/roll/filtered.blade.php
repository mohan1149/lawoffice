@extends('admin.layout.app')

<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.case_roll"))
@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="container-fluid">
                        <div>
                        </div>
                    </div>
                    <div class="x_content">
                        <table id="slidersTable" class="table responsive responsive-table">
                            <thead>
                                <tr>
                                    <th>{{__("t.case_number")}}</th>
                                    <th>{{__("t.priority")}}</th>
                                    <th>{{__("t.client_name")}}</th>
                                    <th>{{__("t.next_hearing")}}</th>
                                    <th>{{__("t.client_position")}}</th>
                                    <th>{{__("t.case_status")}}</th>
                                    <th>{{__("t.exe_status")}}</th>
                                    <th>{{__("t.notice_status")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cases as $case)
                                    <tr>
                                        <td>{{ $case->case_number }}</td>
                                        <td>{{ $case->priority }}</td>
                                        <td>{{ $case->first_name.' '.$case->last_name }}</td>
                                        <td>{{ $case->next_date }}</td>
                                        <td>{{ $case->client_position }}</td>
                                        <td>{{ $case->case_status_name }}</td>
                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
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
                targets: 4,
                orderable: false,
                searchable: false,
            },
        ],
    });
} );
</script>
