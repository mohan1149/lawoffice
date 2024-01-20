@extends('admin.layout.app')
@section('title','Invoice View')
@push('stylesheets')

@section('content')
    <!-- /page content start -->
    <div class="x_panel">
        <div id="content">
            <div class="col-md-12">
                <div class="right-part-bg-all">
                    <div class="ctzn-usrs">
                        <div class="row">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#sendInvoiceModal">{{ __("t.send_to_client") }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="modal" tabindex="-1" role="dialog" id='sendInvoiceModal'>
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{ __("t.enter_the_invoice_url") }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="invoice_link" class="form-control">
                            </div>
                            <div class="modal-footer">
                              <a phone="{{ $advocate_client->mobile }}" id="invoice_whatsapp_link" href="https://web.whatsapp.com/" target="_blank" type="button" class="btn btn-primary">{{ __("t.send") }}</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("t.close")}}</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <form id="add_invoice" name="add_invoice" role="form" method="POST" action="{{url('admin/add_invoice')}}"
                  autocomplete="off">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="row">
                        <!-- Section Right Part Start -->
                        <!-- Col-md-6 Start -->
                        <div class="col-md-12">
                            <div class="right-part-bg-all">
                                <div class="ctzn-usrs">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a target="_blank"
                                               href="{{url('admin/create-Invoice-view-detail/'.$invoice->id.'/print')}}"
                                               title="Print invoice"><i class="fa fa-print fa-2x pull-right"
                                                                        aria-hidden="true"></i></a>
                                            <div class="clearfix">
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="text-center">{{__("t.invoice")}} </h1>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="invoice-title">
                                                <h3 class="pull-right">{{__("t.invoice_no")}}: {{ $invoice_no ?? ''}}</h3>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <address>
                                                        <div class="margin-top-30">

                                                            <div class="discount_text">


                                                                <strong>{{__("t.billed_to")}}:</strong>
                                                                {{ucfirst($advocate_client->first_name)." ".$advocate_client->middle_name." ".$advocate_client->last_name }}

                                                                <br>
                                                                <strong>{{__("t.address")}}: </strong>{{ $advocate_client->address.' ,'.$city}}

                                                                <br>
                                                                <strong>{{__("t.mobile")}}: </strong> {{$advocate_client->mobile}}
                                                    </address>
                                                </div>
                                                <div class="col-xs-6 text-right">
                                                    <address>
                                                        <strong>{{__("t.invoice_date")}}:</strong> {{ $inv_date ?? ''}}<br>

                                                        <strong>{{__("t.invoice_due_date")}}:</strong> {{ $due_date ?? ''}}<br>


                                                    </address>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">

                                                </div>
                                                <div class="col-xs-6 text-right">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-default">

                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-condensed">
                                                            <thead>
                                                            <tr>
                                                                <td class="text-center"><strong>{{__("t.no")}}</strong></td>
                                                                <td class="text-left"><strong>{{__("t.service")}}</strong></td>
                                                                <td class="text-left"><strong>{{__("t.description")}}</strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong>{{__("t.qty")}}</strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong>{{__("t.rate")}}</strong></td>
                                                                <td class="text-center" width="10%">
                                                                    <strong>{{__("t.amount")}}</strong></td>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @php $i=1; @endphp
                                                            @if(!empty($iteam) && count($iteam)>0)
                                                                @foreach($iteam as $key=>$value)
                                                                    <tr>
                                                                        <td class="text-center">{{$i}}</td>
                                                                        <td class="text-left">{{$value['service_name']}}</td>
                                                                        <td class="text-left">{{ $value['custom_items_name'] }}</td>

                                                                        <td class="text-center">{{ $value['custom_items_qty'] }}</td>
                                                                        <td class="text-center">{{ $value['item_rate'] }}</td>
                                                                        <td class="text-center">{{$value['custom_items_amount']}}</td>
                                                                    </tr>
                                                                    @php $i++; @endphp
                                                                @endforeach

                                                            @endif


                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        @php if($invoice->remarks!=''){ 
                                        @endphp
                                        <div class="col-sm-7 col-md-7">
                                            <div class="contct-info">
                                                <div class="form-group">
                                                    <label class="discount_text"> {{__("t.note")}}
                                                    </label>
                                                    <p>{{$invoice->remarks ?? ''}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @php }  @endphp
                                        <div class="pull-right col-md-4 invoice-margin-right-32">

                                            <table class="table row-border dataTable no-footer" id="tab_logic_total">

                                                <tr>
                                                    <td width="75%" align="right"><b
                                                                class="font-size-expense-17">{{__("t.subtotal")}}</b></td>
                                                    <td width="25%" align="right"><b
                                                                class="font-size-expense-17">{{$subTotal}}</b></td>
                                                </tr>

                                                <tr>
                                                    <td width="75%" align="right"><b
                                                                class="font-size-expense-17">{{__("t.tax")}}</b>
                                                    </td>
                                                    <td width="25%" align="right"><b
                                                                class="font-size-expense-17">{{$tax_amount}}</b></td>
                                                </tr>


                                                <tr>
                                                    <td align="right"><b class="font-size-expense-17">{{__("t.total")}}</b></td>
                                                    <td align="right"><b
                                                                class="font-size-expense-17">{{ $total_amount }}</b>
                                                    </td>
                                                </tr>


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


    <!-- /page content end  -->
@endsection
@push('scripts')
@endpush
