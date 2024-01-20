<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo e(__('t.invoice_payment_history')); ?></title>
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
        <h2 style="text-align:center;"> <?php echo e(__("t.payment_history")); ?></h2>
	<hr>
	<table>
		<tr>
   			<th> <?php echo e(__("t.invoice_id")); ?> </th>
			<th> <?php echo e(__("t.reference_number")); ?> </th>
			<th> <?php echo e(__("t.amount_received")); ?></th>
			<th> <?php echo e(__("t.receiving_date")); ?> </th>
			<th> <?php echo e(__("t.payment_type")); ?> </th>
			<!-- <th> <?php echo e(__("t.remaining")); ?> </th>
			<th> <?php echo e(__("t.total")); ?> </th>	-->
		</tr>
		<tr>
			<td> <?php echo e($history->invoice_id); ?> </td>
			<td> <?php echo e($history->reference_number); ?> </td>
			<td> <?php echo e($history->amount); ?></td>
			<td> <?php echo e($history->receiving_date); ?> </td>
			<td> <?php echo e($history->payment_type); ?> </td>
		</tr>
	</table>
	<br>
	<hr>
        <div> <?php echo e(__('t.note')." = ".$history->note); ?></div>

    </div>
</body>
</html>
