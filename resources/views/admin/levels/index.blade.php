@extends('admin.layout.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@section('title',__("t.case_levels"))
@section('content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="container-fluid">
                        <div>
                            <div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#level1" aria-controls="level1" role="tab" data-toggle="tab">{{ __("t.level1") }}</a></li>
                                    <li role="presentation"><a href="#level2" aria-controls="level2" role="tab" data-toggle="tab">{{ __("t.level2") }}</a></li>
                                    <li role="presentation"><a href="#level3" aria-controls="level3" role="tab" data-toggle="tab">{{ __("t.level3") }}</a></li>
                                    <li role="presentation"><a href="#level4" aria-controls="level4" role="tab" data-toggle="tab">{{ __("t.level4") }}</a></li>
                                    <li role="presentation"><a href="#level5" aria-controls="level5" role="tab" data-toggle="tab">{{ __("t.level5") }}</a></li>
                                    <li role="presentation"><a href="#level6" aria-controls="level6" role="tab" data-toggle="tab">{{ __("t.level6") }}</a></li>
                                </ul>
                                <br>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="level1">
                                        <table id="tableL1" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l1'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/1">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="level2">
                                        <table id="tableL2" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l2'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/2">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="level3">
                                        <table id="tableL3" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l3'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/3">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="level4">
                                        <table id="tableL4" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l4'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/4">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="level5">
                                        <table id="tableL5" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l5'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/5">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="level6">
                                        <table id="tableL6" class="table responsive responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__("t.case_number")}}</th>
                                                    <th>{{__("t.priority")}}</th>
                                                    <th>{{__("t.next_hearing")}}</th>
                                                    <th>{{__("t.client_position")}}</th>
                                                    <th>{{__("t.exe_status")}}</th>
                                                    <th>{{__("t.notice_status")}}</th>
                                                    <th>{{__("t.actions")}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data['l6'] as $case)
                                                    <tr>
                                                        <td>{{ $case->case_number }}</td>
                                                        <td>{{ $case->priority }}</td>
                                                        <td>{{ $case->next_date }}</td>
                                                        <td>{{ $case->client_position }}</td>
                                                        <td>{{ $case->exe_status == 0 ? __('t.not_done') : __('t.done') }}</td>
                                                        <td>{{ $case->notice_status == 0 ? __('t.not_sent') : __('t.sent') }}</td>
                                                        <td><a href="/admin/case/level/view/{{ $case->id }}/6">{{ __("t.view") }}</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              </div>
                        </div>
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
        $('#tableL1').DataTable({
            columnDefs: [
                {
                    targets: 4,
                    orderable: false,
                    searchable: false,
                },
            ],
        }); 
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let level = $(e.currentTarget).attr('aria-controls');
        let key = level[level.length-1];
        if( !$('#tableL'+key)[0].attributes.class.nodeValue.includes('dataTable')){
            $('#tableL'+key).DataTable({
                columnDefs: [
                    {
                        targets: 4,
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
        }
    });
} );
</script>
