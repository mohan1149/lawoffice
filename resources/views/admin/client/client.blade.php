@extends('admin.layout.app')
@section('title','Client')
@section('content')
    <div class="">
        @component('component.heading' , [
       'page_title' => __("t.client"),
       'action' => route('clients.create') ,
       'text' => __("t.add_client"),
       'permission' => $adminHasPermition->can(['client_add'])
        ])
        @endcomponent

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">
                        <table id="clientDataTable" class="table" data-url="{{ route('clients.list') }}">
                            <thead>
                            <tr>
                                <th width="5%"> {{__("t.No")}}</th>
                                <th> {{__("t.client_name")}}</th>
                                <th width="5%"> {{__("t.mobile")}}</th>
                                <th width="5%" data-orderable="false"> {{__("t.case")}}</th>
                                <th width="5%" data-orderable="false"> {{__("t.status")}}</th>
                                <th width="5%" data-orderable="false" class="text-center"> {{__("t.action")}}</th>
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
    <script src="{{asset('assets/js/client/client-datatable.js')}}"></script>
@endpush
