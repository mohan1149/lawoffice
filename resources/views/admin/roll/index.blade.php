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
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_num">
                                                {{__("t.case_number")}}
                                            </label>
                                            <input value="{{ request('case_number') }}" type="text" name="case_number" id="case_num" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_type">
                                                {{__("t.case_type")}}
                                            </label>
                                            <select name="case_type" class="form-control">
                                                <option value="0">----</option>
                                                @foreach ($filter_data['types'] as $key => $type)
                                                    <option {{ request('case_type') == $key ? 'selected':'' }} value="{{ $key }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="case_status">
                                                {{__("t.case_status")}}
                                            </label>
                                            <select name="case_level" class="form-control" required>
                                                    <option {{ request('case_level') == 'police' ? 'selected':'' }} value="police">{{ __('t.police') }}</option>
                                                    <option {{ request('case_level') == 'prosecution' ? 'selected':'' }} value="prosecution">{{ __('t.prosecution') }}</option>
                                                    <option {{ request('case_level') == 'first-degree' ? 'selected':'' }} value="first-degree">{{ __('t.first-degree') }}</option>
                                                    <option {{ request('case_level') == 'resumption' ? 'selected':'' }} value="resumption">{{ __('t.resumption') }}</option>
                                                    <option {{ request('case_level') == 'excellence' ? 'selected':'' }} value="excellence">{{ __('t.excellence') }}</option>
                                                    <option {{ request('case_level') == 'expert' ? 'selected':'' }} value="expert">{{ __('t.expert') }}</option>
                                                    <option {{ request('case_level') == 'shapes' ? 'selected':'' }} value="shapes">{{ __('t.shapes') }}</option>
                                                </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">
                                                {{__("t.start_date")}}
                                            </label>
                                            <input value="{{ request("start_date") }}" type="date" name="start_date" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">
                                                {{__("t.end_date")}}
                                            </label>
                                            <input value="{{ request('end_date') }}" type="date" name="end_date" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="priority">
                                                {{__("t.priority")}}
                                            </label>
                                            <select name="priority" class="form-control">
                                                <option value="0">----</option>
                                                <option {{ request('priority') == "High" ? 'selected':'' }} value="High">{{ __("t.high") }}</option>
                                                <option {{ request('priority') == "Medium" ? 'selected':'' }} value="Medium">{{ __("t.medium") }}</option>
                                                <option {{ request('priority') == "Low" ? 'selected':'' }} value="Low">{{ __("t.low") }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="court">
                                                {{__("t.court")}}
                                            </label>
                                            <select name="court" class="form-control">
                                                <option value="0">----</option>
                                                @foreach ($filter_data['courts'] as $key => $court)
                                                    <option  {{ request('court') == $key ? 'selected':'' }}  value="{{ $key }}">{{ $court }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exe_status">
                                                {{__("t.exe_status")}}
                                            </label>
                                            <select name="exe_status" class="form-control">
                                                <option value="2">----</option>
                                                <option {{ request('exe_status') == "0" ? 'selected':'' }} value="0">{{ __("t.not_done") }}</option>
                                                <option {{ request('exe_status') == "1" ? 'selected':'' }} value="1">{{ __("t.done") }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="{{ url()->full()."&pdf=true" }}" class="btn btn-danger">{{ __("t.pdf") }}</a>
                                        <input class="btn btn-primary" type="submit" value="{{ __("t.filter") }}">
                                    </div>
                                </div>
                            </form>
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
                                    <th>{{__("t.exe_status")}}</th>
                                    <th>{{__("t.notice_status")}}</th>
                                    <th>{{__("t.case_level")}}</th>
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
                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                        <td class="text red">{{ __("t.".$case->case_level) }}</td>
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
