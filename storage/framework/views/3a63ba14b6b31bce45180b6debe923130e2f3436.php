<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice#<?php echo e($invoice_no ?? ''); ?> | Advocate Diary</title>
    <style type="text/css">
        @media  print {
            body {
                margin: 3mm 8mm 5mm 5mm;
            }
        }

        @page  {
            margin: 3mm 8mm 5mm 5mm;
        }
    </style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="25%">
	                    <img src="https://fatmashaddadlawoffice.com/logo.png"width="100px"  alt="">
                    </td>
                    <td width="75%" valign="top">
                        <h1 class="heading1" style="text-align: center;"><b><?php echo e($header['company_name'] ?? ""); ?></b></h1>

                        <center><?php echo e($header['address'].',' ?? ''); ?> <?php echo e($header["city"]); ?> <?php echo e(" - ".$header["pincode"].',' ?? ''); ?>  <?php echo e($header["state"].',' ?? ''); ?>  <?php echo e($header["country"] ?? ''); ?>  </center>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<hr>
<br>

<table border="1" cellpadding="0" cellspacing="0" width="100%"
       style="border-collapse:collapse;font-size: 13px;border: 1px solid #000;">

    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="64%">
                        <table border="0" cellpadding="5" cellspacing="0" width="100%">
                            <tr>
                                <td width="96%" style="font-size: 12px;">
                                    <b> Billed To:</b>
                                    <br>
                                    <?php echo e($advocate_client->first_name." ".$advocate_client->middle_name." ".$advocate_client->last_name); ?>

                                    <br>
                                    <strong>Address:- </strong><?php echo e($advocate_client->address); ?>

                                    <?php echo e(','.$header["city"]); ?>

                                    <br>
                                    <strong>Mobile:- </strong> <?php echo e($advocate_client->mobile); ?>

                                    <br/>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="36%" valign="top">
                        <table width="100%" border="0" cellpadding="4" cellspacing="0"
                               style="border-left:1px solid black;">
                            <tr>
                                <td width="50%"><strong>Invoice No.</strong></td>
                                <td width="50%">: <?php echo e($invoice_no ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td style=""><strong>Invoice Date:</strong></td>
                                <td style="">: <?php echo e($inv_date ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom:0px solid black;"><strong>Invoice Due Date:</strong></td>
                                <td style="border-bottom:0px solid black;">: <?php echo e($due_date ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td style="border-bottom:0px solid black;" colspan="2"></td>
                                <td style="border-bottom:0px solid black;" colspan="2"></td>
                            </tr>
                            <tr>
                                <td style="border-bottom:0px solid black;" colspan="2"></td>
                                <td style="border-bottom:0px solid black;" colspan="2"></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>


    <tr>
        <td height="0" style="border: 0px solid #fff;" border="0" valign="top">
            <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                    <td width="3%" align="center"
                        style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;">
                        <strong>Sr.</strong></td>
                    <td width="25%" align="left"
                        style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><strong>Service</strong>
                    </td>
                    <td width="50%" align="left"
                        style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><strong>Description</strong>
                    </td>

                    <td width="9%" align="center"
                        style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><strong>Quantity</strong>
                    </td>
                    <td width="7%" align="center"
                        style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;">
                        <strong>Rate</strong></td>

                    <td width="15%" align="center" style="border-bottom: 1px solid #000;font-size: 9pt;"><strong>Net
                            <br>Amount</strong></td>
                </tr>


                <?php $i=1; ?>
                <?php if(!empty($iteam) && count($iteam)>0): ?>
                    <?php $__currentLoopData = $iteam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td align="center"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo e($i); ?></td>
                            <td align="left"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo e($value['service_name'] ?? ''); ?></td>
                            <td align="left"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo e($value['custom_items_name']); ?></td>
                            <td align="center"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo e($value['custom_items_qty']); ?></td>
                            <td align="right"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo e($value['item_rate']); ?></td>

                            <td align="center"
                                style="border-right: 1px solid #000;border-bottom: 1px solid #000;font-size: 9pt;"><?php echo App\Helpers\LogActivity::moneyFormatIndia(round($value['custom_items_amount'])); ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>
                <tr>
                    <td style="border-right: 1px solid #000;font-size: 9pt;"></td>
                    <td align="center" style="border-right: 1px solid #000;font-size: 9pt;"><strong>Total</strong></td>
                    <td align="center" style="border-right: 1px solid #000;font-size: 9pt;"></td>
                    <td align="right" style="border-right: 1px solid #000;font-size: 9pt;"></td>

                    <td align="center" style="border-right: 1px solid #000;font-size: 9pt;"></td>
                    <td align="center" style="border-right: 1px solid #000;font-size: 9pt;"></td>
                </tr>
            </table>
        </td>
    </tr>


    <tr>
        <td>
            <table border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    
                    </td>
                    <td width="28%" border="0" style="border-left:1px solid black;">
                        <table width="100%" border="0">
                            <tr>
                                <td width="75%" style="font-weight: bolder;">SubTotal</td>
                                <td width="25%" style="font-weight: bolder;" align="right"><?php echo e($subTotal); ?></td>
                            </tr>

                            <tr>
                                <td width="75%" style="font-weight: bolder;">Tax</td>
                                <td width="25%" style="font-weight: bolder;" align="right"><?php echo e($tax_amount); ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bolder;">Total</td>
                                <td style="font-weight: bolder;" align="right"><?php echo e($total_amount); ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            
        </td>
    </tr>
</table>
</body>
</html>
