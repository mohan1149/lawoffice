<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="Paymentmadehistory">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&{{__("t.times")}};</button>
	<h4 class="modal-title">{{__("t.paymennt_made_history")}}</h4>
</div>
    <div class="modal-body">
        <div class="row">
		<div class="col-md-12">
			<table class="table">
    <thead>
      <tr>
        <th>{{__("t.invoice_no")}}</th>
        <th>{{__("t.amount")}}</th>
        <th>{{__("t.receiving_date")}} </th>
        <th>{{__("t.payment_method")}}</th>
        <th>{{__("t.reference_number")}}</th>
        <th>{{__("t.note")}}</th>
      </tr>
    </thead>
    <tbody>
	@forelse($getPaymentHistory as $history)
      <tr>
        <td>{{$history->invoice_no}}</td>
        <td><i class="fa fa-inr"></i>&nbsp;{!! App\Helpers\LogActivity::moneyFormatIndia(round($history->amount)) !!}</td>
        <td>{{date(LogActivity::commonDateFromatType(),strtotime($history->receiving_date))}}</td>
        <td>{{$history->payment_type}} @if($history->payment_type=='Cheque') ({{date(LogActivity::commonDateFromatType(),strtotime($history->cheque_date))}}) @endif</td>
        <td>{{$history->reference_number ?? 'N/A'}}</td>
        <td><a href="javascript:void(0);" tabindex="0" class="text-right" data-placement="bottom" data-toggle="popover" data-trigger="focus" title="Remarks" data-content="{{$history->note ?? 'N/A'}}"><i class="fa fa-eye"</a></td>
      </tr>
	@empty
		  <tr>
			<td colspan="6" class="text-center">{{__("t.no_record_found")}}.</td>
		</tr>
	@endforelse
    </tbody>
  </table>
	</div>
	</div>
	</div> 

  </div>
  </div>
  </div> 

	<script>


	$(document).ready(function() {
        "use strict";
        $('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
	});
	</script>