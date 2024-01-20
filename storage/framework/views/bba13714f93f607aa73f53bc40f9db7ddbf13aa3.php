<!DOCTYPE html>
<html lang="en">
<head>
<style>
.container
{
margin:auto;
width:95%;
}
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
  text-align:center;
}
.remove-border
{
border:none !important;
border-left: none !important;
border-top: none !important;
border-right: none !important;
border-bottom: none !important;

}

.heading1{
font-size:20px;
font-style:bold;
font-weight: bold;
/* font-family:Arial, Helvetica, sans-serif; */
}

.heading2{
font-size:17px;
font-style:bold;
font-weight: bold;
}

.heading3{
font-size:12px;
font-style:bold;
font-family: sans-serif;
}
</style>
<title> <?php echo e(__("t.case_details")); ?> | <?php echo e($case->registration_number ?? ''); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="container">
	<img src="https://fatmashaddadlawoffice.com/logo.png" alt="" width="100px">
	<h1 class="heading1" style="text-align: center;"><b><?php echo e($setting->company_name ?? ''); ?></b></h1>
  	<center><?php echo e($setting->address.',' ?? ''); ?> <?php echo e($setting->citys->name); ?> <?php echo e(" - ".$setting->pincode.',' ?? ''); ?>  <?php echo e($setting->states->name.',' ?? ''); ?>  <?php echo e($setting->countrys->name ?? ''); ?>  </center>
  <hr>

<table width="100%" border="0" style="border-style:none">

<tr>
<td class="remove-border heading1" width="100%" ><b><?php echo e($case->court_name ?? ''); ?></b></td>
</tr>
<tr>
<td class="remove-border heading2" width="100%" ><?php echo e($case->judgeType ?? ''); ?></td>
</tr>
</table>


<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.case_details")); ?></h1>


<table  width="100%" style="margin-top:12px; border-style: solid;">
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> <?php echo e(__("t.case_type")); ?> </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;">:
 			<?php if(isset($case->caseType) && !empty($case->caseType)): ?> <?php echo e($case->caseType ?? ''); ?> <?php endif; ?>
		</td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"></td>
	</tr>
	<?php if(isset($case->caseSubType) && !empty($case->caseSubType)): ?>
		<tr>
			<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> <?php echo e(__("t.case_sub_type")); ?> </td>
			<td class="heading3" width="60%" style="text-align:left;border-left: none;border-right: none;">:
				<?php if(isset($case->caseSubType) && !empty($case->caseSubType)): ?>
					<?php echo e($case->caseSubType); ?>

				<?php endif; ?>
			</td>
			<td class="heading3" width="10%" style="text-align:left;border-left: none;border-right: none;"></td>
		</tr>
	<?php endif; ?>
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> <?php echo e(__("t.filling_number")); ?> </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;"> :  <?php if(isset($case->filing_number) && !empty($case->filing_number)): ?> <?php echo e($case->filing_number ?? ''); ?> <?php endif; ?></td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"> <?php echo e(__("t.filling_date")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
			<?php if(isset($case->filing_date) && !empty($case->filing_date)): ?> <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->filing_date)))); ?> <?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> <?php echo e(__("t.registration_number")); ?> </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;">: <?php if(isset($case->registration_number) && !empty($case->registration_number)): ?> <?php echo e($case->registration_number ?? ''); ?> <?php endif; ?></td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"> <?php echo e(__("t.registration_date")); ?> : <?php if(isset($case->registration_date) && !empty($case->registration_date)): ?> <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->registration_date)))); ?> <?php endif; ?></td>
	</tr>


</table>

<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.case_status")); ?></h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.first_hearing_date")); ?>  </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: <?php if(isset($case->first_hearing_date) && !empty($case->first_hearing_date)): ?>

 <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->first_hearing_date)))); ?>


  <?php endif; ?></td>
</tr>
<?php if($case->decision_date != ''): ?>
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.decision_date")); ?> </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  <?php if(isset($case->decision_date) && !empty($case->decision_date)): ?>

	 <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->decision_date)))); ?>


  <?php endif; ?></td>
</tr>
<?php else: ?>
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.next_hearing_date")); ?> </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  <?php if(isset($case->next_date) && !empty($case->next_date)): ?>

		 <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->next_date)))); ?>


  <?php endif; ?></td>
</tr>
<?php endif; ?>

<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.case_status")); ?> </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: <?php if(isset($case->case_status_name) && !empty($case->case_status_name)): ?> <?php echo e($case->case_status_name); ?> <?php endif; ?></td>
</tr>

<?php if($case->nature_disposal != ''): ?>
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.nature_of_disposal")); ?> </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: <?php echo e($case->nature_disposal); ?>

</td>
</tr>
<?php endif; ?>

<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"><?php echo e(__("t.court_number_and_judge")); ?> </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  <?php if(isset($case->court_no) && !empty($case->court_no)): ?> <?php echo e($case->court_no); ?> <?php endif; ?> - <?php if(isset($case->judgeType) && !empty($case->judgeType)): ?> <?php echo e($case->judgeType); ?> <?php endif; ?>
</td>
</tr>


</table>



  



<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.petitioner_and_advocate")); ?></h1>


<div style="border: solid;border-width: thin;">
   <?php if(count($petitioner_and_advocate)>0 && !empty($petitioner_and_advocate)): ?>
	  <?php $i=1; ?>
			<?php $__currentLoopData = $petitioner_and_advocate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<span style="margin-left:10px; " class="heading3"> <?php echo e($i.') '.$value['party_name']); ?></span><br/>
			    <span style="margin-left:10px; " class="heading3"> <?php echo e(__("t.advocate")); ?> -   <?php echo e($value['party_advocate']); ?> </span><br/>
				  <?php $i++; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
</div>

<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.respondent_and_advocate")); ?></h1>

<div style="border: solid;border-width: thin;">
	<?php if(count($respondent_and_advocate)>0 && !empty($respondent_and_advocate)): ?>
	  <?php $j=1; ?>
			<?php $__currentLoopData = $respondent_and_advocate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			   <span style="margin-left:10px; " class="heading3"> <?php echo e($j.') '.$value['party_name']); ?></span><br/>
			   <span style="margin-left:10px;padding-bottom: 15px; " class="heading3"> <?php echo e(__("t.advocate")); ?> -   <?php echo e($value['party_advocate']); ?> </span><br/>
				  <?php $j++; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
</div>
<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.acts")); ?></h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="50%" style="text-align:center !important;"><b><?php echo e(__("t.undee_acts")); ?> </b></td>
<td class="heading3" width="50%" style="text-align: center;"><b><?php if(isset($case->act) && !empty($case->act)): ?> <?php echo e($case->act); ?> <?php endif; ?></b></td>
</tr>
</table>

<?php if(isset($case->police_station) && !empty($case->police_station)): ?>
<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.fir_details")); ?></h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="25%" style="text-align:left !important;"><?php echo e(__("t.police_station")); ?></td>
<td class="heading3" width="75%" style="text-align: left;"><b><?php if(isset($case->police_station) && !empty($case->police_station)): ?> <?php echo e($case->police_station); ?> <?php endif; ?></b></td>
</tr>

<tr>
<td class="heading3 " width="25%" style="text-align:left !important;"><?php echo e(__("t.fir_number")); ?></td>
<td class="heading3" width="75%" style="text-align:left !important;"><?php if(isset($case->fir_number) && !empty($case->fir_number)): ?> <?php echo e($case->fir_number); ?> <?php endif; ?></td>
</tr>

<tr>
<td class="heading3 " width="25%" style="text-align:left !important;"><?php echo e(__("t.year")); ?></td>
<td class="heading3" width="75%" style="text-align:left !important;"><?php if(isset($case->fir_date) && !empty($case->fir_date)): ?> <?php echo e(date('Y',strtotime(LogActivity::commonDateFromat($case->fir_date)))); ?> <?php endif; ?></td>
</tr>
</table>
<?php endif; ?>
<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.history_of_case_hearing")); ?></h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="20%" style="text-align:center !important;"><b><?php echo e(__("t.registration_number")); ?> </b></td>
<td class="heading3 " width="30%" style="text-align:center !important;"><b><?php echo e(__("t.judge")); ?> </b></td>
<td class="heading3 " width="10%" style="text-align:center !important;"><b><?php echo e(__("t.business_on_date")); ?> </b></td>
<td class="heading3" width="10%" style="text-align: center;"><b><?php echo e(__("t.hearing_date")); ?></b></td>
<td class="heading3" width="30%" style="text-align: center;"><b><?php echo e(__("t.purpose_of_hearing")); ?></b></td>
</tr>

<?php if(count($history)>0 && !empty($history)): ?>
		<?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>
<td class="heading3 " width="20%" style="text-align:center !important;"><?php echo e($h->registration_number ?? ''); ?></td>
<td class="heading3 " width="20%" style="text-align:center !important;"><?php echo e($h->judge_name ?? ''); ?> </td>
<td class="heading3 " width="20%" style="text-align:center !important;"><?php if(isset($h->bussiness_on_date) && !empty($h->bussiness_on_date)): ?> <?php echo e(date(LogActivity::commonDateFromatType(),strtotime($h->bussiness_on_date))); ?> <?php endif; ?></td>
<td class="heading3" width="20%" style="text-align: center;"> <?php if(isset($h->hearing_date) && !empty($h->hearing_date)): ?> <?php echo e(date(LogActivity::commonDateFromatType(),strtotime($h->hearing_date))); ?> <?php endif; ?></td>
<td class="heading3" width="20%" style="text-align: center;"><?php echo e($h->case_status_name ?? ''); ?></td>
</tr>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</table>
<h1 class="heading2" style="text-align: center;"><?php echo e(__("t.Case_Transfer_Details_Between_The_Courts")); ?></h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="15%" style="text-align:center !important;"><b><?php echo e(__("t.Regn_Number")); ?>  </b></td>
<td class="heading3 " width="15%" style="text-align:center !important;"><b><?php echo e(__("t.Transfer_Date")); ?></b></td>
<td class="heading3 " width="35%" style="text-align:center !important;"><b><?php echo e(__("t.From_Court_Number_and_Judge")); ?></b></td>
<td class="heading3" width="35%" style="text-align: center;"><b><?php echo e(__("t.To_Court_Number_and_Judge")); ?></b></td>
</tr>

<?php if(count($transfer)>0 && !empty($transfer)): ?>
		<?php $__currentLoopData = $transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td class="heading3 " width="15%" style="text-align:center !important;"><?php echo e($t->registration_number ?? ''); ?> </td>
<td class="heading3 " width="15%" style="text-align:center !important;"><?php if(isset($t->transferDate) && !empty($t->transferDate)): ?> <?php echo e(date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($t->transferDate)))); ?> <?php endif; ?></td>
<td class="heading3 " width="35%" style="text-align:center !important;"><?php echo e($t->from_court_no ?? ''); ?> - <?php echo e($t->judge_name ?? ''); ?></td>
<td class="heading3" width="35%" style="text-align: center;"><?php echo e($t->to_court_no ?? ''); ?> - <?php echo e($t->transferJudge ?? ''); ?>

</td>
</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

</table>
</div>
</body>
</html>
