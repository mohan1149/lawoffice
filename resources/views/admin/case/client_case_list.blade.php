@extends('admin.layout.app')
@section('title','Client View')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h4>{{__('t.client_name')}} : {{$name}} </h4>
        </div>
        <div class="pull-right">
            <h4> {{__('t.total_case')}} : {{$totalCourtCase ?? ''}} </h4>
        </div>

    </div>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">

                    <table id="client_case_listDatatable" class="table"
                           data-url="{{ route('client.case_view.list') }}">
                        <thead>
                        <tr>
                            <th>{{__('t.no')}}</th>
                            <th data-orderable="false">{{__('t.case_details')}}</th>
                            <th data-orderable="false">{{__('t.court_details')}}</th>
                            <th data-orderable="false">{{__('t.petitioner_vs_respondent')}}</th>
                            <th data-orderable="false">{{__('t.next_date')}}</th>
                            <th data-orderable="false">{{__('t.status')}}</th>
                            <th data-orderable="false">{{__('t.action')}}</th>
                        </tr>
                        </thead>



                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-case-priority" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-change-court" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_transfer">

            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-next-date" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal_next_date">

            </div>
        </div>
    </div>
    <input type="hidden" name="get_case_important_modal"
           id="get_case_important_modal"
           value="{{url('admin/getCaseImportantModal')}}">

    <input type="hidden" name="get_case_next_modal"
           id="get_case_next_modal"
           value="{{url('admin/getNextDateModal')}}">

    <input type="hidden" name="get_case_cort_modal"
           id="get_case_cort_modal"
           value="{{url('admin/getChangeCourtModal')}}">

    <input type="hidden" name="advo_client_id"
           id="advo_client_id"
           value="{{$advo_client_id}}">

@endsection
@push('js')
    <script src="{{asset('assets/js/case/case-client-datatable.js')}}"></script>

@endpush
