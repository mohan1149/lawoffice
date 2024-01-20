@extends('admin.layout.app')
@section('title','Service')
@section('content')
    <div class="">


        @component('component.modal_heading',
             [
             'page_title' =>__("t.service"),
             'action'=>route("service.create"),
             'model_title'=>__("t.add_service"),
             'modal_id'=>'#addtag',
             'permission' => $adminHasPermition->can(['service_add'])
             ] )
            Service
        @endcomponent


        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_content">

                        <table id="serviceDataTable" class="table" data-url="{{ route('service.list') }}"
                        >
                            <thead>
                            <tr>
                                <th width="5%">{{__("t.amount")}}</th>
                                <th>{{__("t.name")}}</th>
                                <th>{{__("t.amount")}}</th>
                                <th width="5%" data-orderable="false">{{__("t.status")}}</th>
                                <th width="2%" data-orderable="false">{{__("t.action")}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="load-modal"></div>
@endsection

@push('js')

    <script src="{{asset('assets/js/service/service-datatable.js')}}"></script>

@endpush
