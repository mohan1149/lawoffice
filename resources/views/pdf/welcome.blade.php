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
<title> {{ __("t.case_details")}} | {{$case->registration_number ?? ''}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div class="container">
	<img src="https://fatmashaddadlawoffice.com/logo.png" alt="" width="100px">
	<h1 class="heading1" style="text-align: center;"><b>{{$setting->company_name ?? ''}}</b></h1>
  	<center>{{$setting->address.',' ?? ''}} {{$setting->citys->name }} {{" - ".$setting->pincode.',' ?? ''}}  {{$setting->states->name.',' ?? '' }}  {{$setting->countrys->name ?? '' }}  </center>
  <hr>

<table width="100%" border="0" style="border-style:none">

<tr>
<td class="remove-border heading1" width="100%" ><b>{{$case->court_name ?? ''}}</b></td>
</tr>
<tr>
<td class="remove-border heading2" width="100%" >{{$case->judgeType ?? ''}}</td>
</tr>
</table>


<h1 class="heading2" style="text-align: center;">{{__("t.case_details")}}</h1>


<table  width="100%" style="margin-top:12px; border-style: solid;">
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> {{__("t.case_type")}} </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;">:
 			@if(isset($case->caseType) && !empty($case->caseType)) {{$case->caseType ?? ''}} @endif
		</td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"></td>
	</tr>
	@if (isset($case->caseSubType) && !empty($case->caseSubType))
		<tr>
			<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> {{ __("t.case_sub_type")}} </td>
			<td class="heading3" width="60%" style="text-align:left;border-left: none;border-right: none;">:
				@if (isset($case->caseSubType) && !empty($case->caseSubType))
					{{ $case->caseSubType }}
				@endif
			</td>
			<td class="heading3" width="10%" style="text-align:left;border-left: none;border-right: none;"></td>
		</tr>
	@endif
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> {{__("t.filling_number")}} </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;"> :  @if(isset($case->filing_number) && !empty($case->filing_number)) {{$case->filing_number ?? ''}} @endif</td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"> {{__("t.filling_date")}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
			@if(isset($case->filing_date) && !empty($case->filing_date)) {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->filing_date)))}} @endif
		</td>
	</tr>
	<tr>
		<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;"> {{__("t.registration_number")}} </td>
		<td class="heading3" width="40%" style="text-align:left;border-left: none;border-right: none;">: @if(isset($case->registration_number) && !empty($case->registration_number)) {{$case->registration_number ?? ''}} @endif</td>
		<td class="heading3" width="30%" style="text-align:left;border-left: none;border-right: none;"> {{__("t.registration_date")}} : @if(isset($case->registration_date) && !empty($case->registration_date)) {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->registration_date)))}} @endif</td>
	</tr>


</table>

<h1 class="heading2" style="text-align: center;">{{__("t.case_status")}}</h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.first_hearing_date")}}  </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: @if(isset($case->first_hearing_date) && !empty($case->first_hearing_date))

 {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->first_hearing_date)))}}

  @endif</td>
</tr>
@if($case->decision_date != '')
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.decision_date")}} </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  @if(isset($case->decision_date) && !empty($case->decision_date))

	 {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->decision_date)))}}

  @endif</td>
</tr>
@else
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.next_hearing_date")}} </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  @if(isset($case->next_date) && !empty($case->next_date))

		 {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($case->next_date)))}}

  @endif</td>
</tr>
@endif

<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.case_status")}} </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: @if(isset($case->case_status_name) && !empty($case->case_status_name)) {{$case->case_status_name}} @endif</td>
</tr>

@if($case->nature_disposal != '')
<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.nature_of_disposal")}} </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">: {{$case->nature_disposal}}
</td>
</tr>
@endif

<tr>
<td class="heading3 " width="30%" style="text-align:left;border-right: none !important;">{{__("t.court_number_and_judge")}} </td>
<td class="heading3" width="70%" style="text-align:left;border-left: none !important;">:  @if(isset($case->court_no) && !empty($case->court_no)) {{$case->court_no}} @endif - @if(isset($case->judgeType) && !empty($case->judgeType)) {{$case->judgeType}} @endif
</td>
</tr>


</table>



  



<h1 class="heading2" style="text-align: center;">{{__("t.petitioner_and_advocate")}}</h1>


<div style="border: solid;border-width: thin;">
   @if(count($petitioner_and_advocate)>0 && !empty($petitioner_and_advocate))
	  @php $i=1; @endphp
			@foreach($petitioner_and_advocate as $value)
				<span style="margin-left:10px; " class="heading3"> {{ $i.') '.$value['party_name'] }}</span><br/>
			    <span style="margin-left:10px; " class="heading3"> {{__("t.advocate")}} -   {{$value['party_advocate'] }} </span><br/>
				  @php $i++; @endphp
			@endforeach
   @endif
</div>

<h1 class="heading2" style="text-align: center;">{{__("t.respondent_and_advocate")}}</h1>

<div style="border: solid;border-width: thin;">
	@if(count($respondent_and_advocate)>0 && !empty($respondent_and_advocate))
	  @php $j=1; @endphp
			@foreach($respondent_and_advocate as $value)
			   <span style="margin-left:10px; " class="heading3"> {{ $j.') '.$value['party_name'] }}</span><br/>
			   <span style="margin-left:10px;padding-bottom: 15px; " class="heading3"> {{__("t.advocate")}} -   {{$value['party_advocate'] }} </span><br/>
				  @php $j++; @endphp
			@endforeach
	@endif
</div>
<h1 class="heading2" style="text-align: center;">{{__("t.acts")}}</h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="50%" style="text-align:center !important;"><b>{{ __("t.undee_acts") }} </b></td>
<td class="heading3" width="50%" style="text-align: center;"><b>@if(isset($case->act) && !empty($case->act)) {{$case->act}} @endif</b></td>
</tr>
</table>

@if(isset($case->police_station) && !empty($case->police_station))
<h1 class="heading2" style="text-align: center;">{{__("t.fir_details")}}</h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="25%" style="text-align:left !important;">{{__("t.police_station")}}</td>
<td class="heading3" width="75%" style="text-align: left;"><b>@if(isset($case->police_station) && !empty($case->police_station)) {{$case->police_station}} @endif</b></td>
</tr>

<tr>
<td class="heading3 " width="25%" style="text-align:left !important;">{{__("t.fir_number")}}</td>
<td class="heading3" width="75%" style="text-align:left !important;">@if(isset($case->fir_number) && !empty($case->fir_number)) {{$case->fir_number}} @endif</td>
</tr>

<tr>
<td class="heading3 " width="25%" style="text-align:left !important;">{{__("t.year")}}</td>
<td class="heading3" width="75%" style="text-align:left !important;">@if(isset($case->fir_date) && !empty($case->fir_date)) {{date('Y',strtotime(LogActivity::commonDateFromat($case->fir_date)))}} @endif</td>
</tr>
</table>
@endif
<h1 class="heading2" style="text-align: center;">{{__("t.history_of_case_hearing")}}</h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="20%" style="text-align:center !important;"><b>{{__("t.registration_number")}} </b></td>
<td class="heading3 " width="30%" style="text-align:center !important;"><b>{{__("t.judge")}} </b></td>
<td class="heading3 " width="10%" style="text-align:center !important;"><b>{{__("t.business_on_date")}} </b></td>
<td class="heading3" width="10%" style="text-align: center;"><b>{{__("t.hearing_date")}}</b></td>
<td class="heading3" width="30%" style="text-align: center;"><b>{{__("t.purpose_of_hearing")}}</b></td>
</tr>

@if(count($history)>0 && !empty($history))
		@foreach($history as $h)

<tr>
<td class="heading3 " width="20%" style="text-align:center !important;">{{$h->registration_number ?? '' }}</td>
<td class="heading3 " width="20%" style="text-align:center !important;">{{$h->judge_name ?? '' }} </td>
<td class="heading3 " width="20%" style="text-align:center !important;">@if(isset($h->bussiness_on_date) && !empty($h->bussiness_on_date)) {{date(LogActivity::commonDateFromatType(),strtotime($h->bussiness_on_date))}} @endif</td>
<td class="heading3" width="20%" style="text-align: center;"> @if(isset($h->hearing_date) && !empty($h->hearing_date)) {{date(LogActivity::commonDateFromatType(),strtotime($h->hearing_date))}} @endif</td>
<td class="heading3" width="20%" style="text-align: center;">{{$h->case_status_name ?? '' }}</td>
</tr>

		@endforeach
@endif

</table>
<h1 class="heading2" style="text-align: center;">{{__("t.Case_Transfer_Details_Between_The_Courts")}}</h1>

<table  width="100%" style="margin-top:12px; border-style: solid;">
<tr>
<td class="heading3 " width="15%" style="text-align:center !important;"><b>{{__("t.Regn_Number")}}  </b></td>
<td class="heading3 " width="15%" style="text-align:center !important;"><b>{{__("t.Transfer_Date")}}</b></td>
<td class="heading3 " width="35%" style="text-align:center !important;"><b>{{__("t.From_Court_Number_and_Judge")}}</b></td>
<td class="heading3" width="35%" style="text-align: center;"><b>{{__("t.To_Court_Number_and_Judge")}}</b></td>
</tr>

@if(count($transfer)>0 && !empty($transfer))
		@foreach($transfer as $t)
<tr>
<td class="heading3 " width="15%" style="text-align:center !important;">{{$t->registration_number ?? '' }} </td>
<td class="heading3 " width="15%" style="text-align:center !important;">@if(isset($t->transferDate) && !empty($t->transferDate)) {{date(LogActivity::commonDateFromatType(),strtotime(LogActivity::commonDateFromat($t->transferDate)))}} @endif</td>
<td class="heading3 " width="35%" style="text-align:center !important;">{{ $t->from_court_no ?? ''}} - {{ $t->judge_name ?? ''}}</td>
<td class="heading3" width="35%" style="text-align: center;">{{ $t->to_court_no ?? ''}} - {{ $t->transferJudge ?? ''}}
</td>
</tr>
		@endforeach
@endif

</table>
</div>
</body>
</html>
