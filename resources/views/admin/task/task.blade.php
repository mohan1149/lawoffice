@extends('admin.layout.app')
@section('title','Task')
@section('content')

    <div class="">
        @component('component.heading' , [
       'page_title' => __("t.task"),
       'action' => route('tasks.create') ,
       'text' => __("t.add_task"),
       'permission' => $adminHasPermition->can(['task_add'])
        ])
        @endcomponent

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table id="clientDataTable" class="table" data-url="{{ route('task.list') }}"
                              >
                            <thead>
                            <tr>
                                <th>{{__("t.no")}}</th>
                                <th>{{__("t.task_name")}}</th>
                                <th>{{__("t.related_to")}}</th>
                                <th>{{__("t.start_date")}}</th>
                                <th>{{__("t.deadline")}}</th>
                                <th>{{__("t.members")}}</th>
                                <th>{{__("t.status")}}</th>
                                <th>{{__("t.priority")}}</th>
                                <th data-orderable="false" class="text-center">{{__("t.action")}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/js/task/task-datatable.js')}}"></script>
@endpush
