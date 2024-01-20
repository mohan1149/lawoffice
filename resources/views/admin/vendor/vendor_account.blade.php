@extends('admin.layout.app')
@section('title','Vendor Account')
@section('content')
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>{{__("t.vendor_name")}} : <span>{{$name}}</span></h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="{{ request()->is('admin/vendor/*') ? 'active' : '' }}"><a
                                            href="{{route('vendor.show',$client->id)}}">{{__("t.vendor_details")}}</a>
                                </li>

                                @if($adminHasPermition->can(['expense_list']))
                                    <li role="presentation"
                                        class="{{ request()->is('admin/expense-account-list/*') ? 'active' : '' }}"><a
                                                href="{{url('admin/expense-account-list/'.$client->id)}}">{{__("t.accounts")}}</a>
                                    </li>
                                @endif
                            </ul>
                            <br><br>
                            <div id="myTabContent" class="tab-content">


                                <table id="VendorAccountDatatable" class="table"
                                       data-url="{{ url('admin/expense-filter-list') }}"
                                       data-vendor="{{$client->id}}">
                                    <thead>
                                    <tr>
                                        <th width="3%">{{__("t.no")}}</th>
                                        <th width="15%">{{__("t.invoice_number")}}</th>
                                        <th width="20%">{{__("t.vendor")}}</th>
                                        <th width="10%">{{__("t.amount")}}</th>
                                        <th width="15%">{{__("t.paid_amount")}}</th>
                                        <th width="15%">{{__("t.amount")}}</th>
                                        <th width="8%">{{__("t.status")}}</th>
                                        <th width="5%">{{__("t.action")}}</th>
                                    </tr>
                                    </thead>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="load-modal"></div>


@endsection
@push('js')
    <script src="{{asset('assets/js/vendor/vendor-account-datatable.js') }}"></script>
@endpush
