@extends('admin.layout.app')
@section('title','Invoice')
@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>{{__("t.invoice")}}</h3>
        </div>

        <div class="title_right">
            <div class="form-group pull-right top_search">
                @if($adminHasPermition->can(['invoice_add']))
                    <a href="{{url('admin/create-Invoice-view')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
                        {{__("t.add_invoice")}}</a>
                @endif


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">
                    <table id="client_list" class="table" >
                        <thead>
                        <tr>
                            <th width="3%;">{{__("t.no")}}</th>
                            <th width="15%">{{__("t.invoice_no")}}</th>
                            <th width="30%">{{__("t.client_name")}}</th>
                            <th width="10%">{{__("t.total").'['.__('t.kwd').']'}}</th>
                            <th width="10%">{{__("t.paid").'['.__('t.kwd').']'}}</th>
                            <th width="15%">{{__("t.due").'['.__('t.kwd').']'}}</th>
                            <th width="5%">{{__("t.status")}}</th>
                            <th width="5%;">{{__("t.action")}}</th>
                        </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>

    </div>
    <div id="load-modal"></div>

    <!-- /page content end  -->
    <div class="modal fade" id="modal-common" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="show_modal">

            </div>
        </div>
    </div>


@endsection


@push('js')


    <input type="hidden" name="token-value"
           id="token-value"
           value="{{csrf_token()}}">

    <input type="hidden" name="invoice-list"
           id="invoice-list"
           value="{{ url('admin/invoice-list') }}">

    <script src="{{asset('assets/js/invoice/invoice-datatable.js')}}"></script>

@endpush
