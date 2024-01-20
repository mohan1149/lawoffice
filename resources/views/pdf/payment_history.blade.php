<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('t.invoice_payment_history') }}</title>
    <style>
	th{
		border:none;
		border-bottom: 2px solid black;
	}
	td{
		border:none;
		border-bottom: 2px solid black;
	}
    </style>
</head>
<body>
    <div>
        <img src="https://fatmashaddadlawoffice.com/logo.png" width="100px" alt="">
    </div>
    <div>
	<br>
        <h2 style="text-align:center;"> {{ __("t.payment_history")  }}</h2>
	<hr>
	<table>
		<tr>
   			<th> {{ __("t.invoice_id") }} </th>
			<th> {{ __("t.reference_number") }} </th>
			<th> {{ __("t.amount_received") }}</th>
			<th> {{ __("t.receiving_date") }} </th>
			<th> {{ __("t.payment_type") }} </th>
			<!-- <th> {{ __("t.remaining") }} </th>
			<th> {{ __("t.total") }} </th>	-->
		</tr>
		<tr>
			<td> {{ $history->invoice_id }} </td>
			<td> {{ $history->reference_number  }} </td>
			<td> {{ $history->amount }}</td>
			<td> {{ $history->receiving_date }} </td>
			<td> {{ $history->payment_type }} </td>
		</tr>
	</table>
	<br>
	<hr>
        <div> {{ __('t.note')." = ".$history->note }}</div>

    </div>
</body>
</html>
