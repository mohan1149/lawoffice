<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Model\Invoice;
use App\Model\Timeslot;
use App\Model\GeneralSettings;
use App\Model\InvoiceSetting;
use App\Model\AdvocateClient;
use App\Helpers\LogActivity;
use PDF;
use App\Admin;
use App\Model\CasePartiesInvolves;



class APIController extends Controller
{
    //

    public function login(Request $request){
        $response = [];
        try {
            $email = strip_tags($request['email']);
            $password = strip_tags($request['password']);
            $user = DB::table('advocate_clients')->where('email',$email)->first();
            if(isset($user)){
                if( Hash::check($password, $user->password) ){
                    $response = [
                        'code'=>200,
                        'status'=>'success',
                        'data'=>$user,
                    ];
                }else{
                    $response = [
                        'code' => 401,
                        'status' => 'failed',
                        'message' => 'incorrect_password',
                        
                    ];
                }
            }else{
                $response = [
                    'code' => 404,
                    'status' => 'failed',
                    'message' => 'email_not_found',
                    
                ];
            }
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function userCases(Request $request){
        try {
            $response = [];
            $uid = $request['uid'];
            $cases = DB::table('court_cases AS case')
                ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
                ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
                ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
                ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
                ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
                ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
                ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
                ->select('case.id AS case_id', 'case.ctitle','case.next_date', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.registration_number AS registration_number','case.case_number as case_number','case.filing_number as filling_number','case.registration_date as registration_date', 'case.act', 'case.priority',
                    'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                    's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', 'ac.first_name', 'ac.middle_name', 'ac.last_name', 'case.updated_by', 'ac.id AS advo_client_id','case.created_at'
                )
                ->where('case.advo_client_id',$uid)
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$cases,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage().'#File='.$e->getFile().'#Line='.$e->getLine(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function userAppointments(Request $request){
        try{
            $response = [];
            $uid = $request['uid'];
	    $appointments = DB::table('appointments')
		->join('admins','admins.id','=','appointments.advocate_id')
		->where('client_id',$uid)   
		->select(['appointments.id','admins.mobile','admins.first_name','admins.last_name','appointments.date','appointments.time']) 
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$appointments,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function userInvoices(Request $request){
        try{
            $response = [];
            $uid = $request['uid'];
            $invoices = DB::table('invoices AS i')
                ->leftJoin('payment_receiveds As p', 'p.invoice_id', '=', 'i.id')
                ->leftJoin('advocate_clients As c', 'c.id', '=', 'i.client_id')
                ->select('i.id AS id', 'p.amount', 'i.inv_date', 'i.due_date', 'c.first_name', 'c.last_name', 'c.middle_name', 'i.invoice_no', 'i.inv_status', 'i.total_amount As total_amount', 'c.id as client_id')
                ->selectRaw('sum(p.amount) as paidAmount')
                ->selectRaw('i.total_amount-SUM(ifnull(p.amount, 0)) AS dueAmount')
                ->where('i.client_id', $uid)
                ->where('i.is_active', 'Yes')
                ->groupBy('i.invoice_no')
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$invoices,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function getCaseDetails(Request $request){
        try {
            $case_id = $request['case_id'];
            $case = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.advo_client_id AS client_id', 'case.next_date', 'case.decision_date', 'case.nature_disposal', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name', DB::raw('CONCAT(ac.first_name, " ", ac.middle_name, " " ,ac.last_name) AS full_name'), 'case.filing_number', 'case.filing_date', 'case.registration_number', 'case.registration_date',
                'case.remark', 'case.description', 'case.cnr_number', 'case.first_hearing_date', 'case.case_number'
            )
            ->where('case.id', $case_id)
            ->first();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$case,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function getInvoiceDetails(Request $request){
        try {
            $invoice_id = $request['invoice_id'];
            $invoice = Invoice::find($invoice_id);
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$invoice,
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function getTimeSlotsByDate(Request $request){
        try {
            $lawer = $request['lawyer'];
            $date = $request['date'];
            $timeslots = DB::table('timeslots')
                ->where('lawyer',$lawer)
                ->where('date',$date)
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$timeslots,
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function getTimeSlots(Request $request){
        try {
            $lawer = $request['lawyer'];
            $dates = DB::table('timeslots')
                ->where('lawyer',$lawer)
                ->distinct('date')
                ->get(['date']);
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$dates,
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function allLawyers(){
	    try{
		    $lawyers = DB::table('admins')->select(['id','first_name','last_name','mobile'])->get();
		    $response = [
			    'code'=>200,
			    'status'=>'success',
			    'data'=>$lawyers,

		    ];
		    return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function caseDocuments(Request $request){
        try{
            $response = [];
            $caseid = $request['case_id'];
            $documents = DB::table('case_documents')
                ->where('case_id',$caseid)    
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$documents,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function publishedSliders(){
        try{
            $response = [];
            $sliders = DB::table('sliders')
                ->where('published',1)    
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$sliders,
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function submitConsultation(Request $request){
        try{
            $response = [];
            $name = strip_tags($request['name']);
            $phone = strip_tags($request['phone']);
            $description = strip_tags($request['description']);
            DB::table('consults')->insert([
                'name'=> $name,
                'phone'=> $phone,
		'description'=> $description,
		'submitted_on' => date('Y-m-d'),
            ]);
            $response = [
                'code'=>200,
                'status'=>'success'
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function getInvoicePaymentHistory(Request $request){
        try {
            $invoice = $request['invoice_id'];
            $payment_history = DB::table('payment_receiveds AS pr')
                ->leftJoin('invoices AS inv', 'pr.invoice_id', '=', 'inv.id')
                ->where('pr.invoice_id', $invoice)
		->orderby('pr.id', 'DESC')
		->select(['pr.id as id','receiving_date','reference_number','invoice_no','inv.client_id','inv.inv_status','inv.total_amount','inv.inv_date','inv.due_date','pr.amount','pr.payment_type','pr.note'])
                ->get();
            $response = [
                'code'=>200,
                'status'=>'success',
                'data'=>$payment_history,
            ];
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function submitAppointment(Request $request){
        try{
            $client_id = $request['user_id'];
            $mobile = $request['mobile'] == null ? "" : $request['mobile'];
            $lawyer_id = $request['lawyer_id'];
            $type = 'exists';
            $tid = $request['tid'];
            $notes = $request['notes'];
            $name = $request['name'];
            $timeslot = DB::table('timeslots')->where('tsid',$tid)->first();
            $time = $timeslot->start_time;
            $date = $timeslot->date;
            $existing = DB::table('appointments')->where('advocate_id',$lawyer_id)->whereDate('date',$date)->whereTime('time',$time)->get();
            if(count($existing) >= 1){
                $response = [
                    'code'=>200,
                    'status'=>'failed',
                    'message'=>'slot_not_available',
                ];
            }else{
                DB::table('appointments')->insert([
                    'client_id'=>$client_id,
                    'advocate_id'=>$lawyer_id,
                    'type'=>$type,
                    'date'=>$date,
                    'time'=>$time,
                    'mobile'=>$mobile,
                    'name'=>$name,
                    'note'=>$notes,
	    ]);
		DB::table('timeslots')->where('tsid',$tid)->delete();
                $response = [
                    'code'=>200,
                    'status'=>'success'
                ];
            }
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }   
    }

    public function streamInvoicePDF(Request $request){
        $id = $request['invoice_id'];
        $settings['setting'] = GeneralSettings::where('id', "1")->first();
        $header = [
            'company_name' =>$settings['setting']->company_name,
            'address' =>$settings['setting']->address,
            'city'=>$settings['setting']->citys->name,
            'state'=>$settings['setting']->states->name,
            'country'=>$settings['setting']->countrys->name,
            'pincode' =>$settings['setting']->pincode,

        ];
        $data['header'] =  $header;
        $data['invoice'] = Invoice::with('invoice_iteam', 'invoice_client')->find($id);
        $term_condition = InvoiceSetting::where('id', 1)->first();
        $data['myTerm'] = [];
        if ($term_condition->term_condition != "") {
            $data['myTerm'] = explode('##', $term_condition->term_condition);
        }
        if (isset($data['invoice']->invoice_iteam) && count($data['invoice']->invoice_iteam) > 0) {
            foreach ($data['invoice']->invoice_iteam as $key => $value) {

                $data['iteam'][$key]['service_name'] = isset($value->servicesname->name) ? $value->servicesname->name : '';
                $data['iteam'][$key]['custom_items_name'] = $value['item_description'];
                $data['iteam'][$key]['hsn'] = $value['hsn'];
                $data['iteam'][$key]['custom_items_amount'] = $value['item_amount'];
                $data['iteam'][$key]['item_rate'] = $value['item_rate'];
                $data['iteam'][$key]['custom_items_qty'] = $value['iteam_qty'];
            }
        }

        $data['advocate_client'] = AdvocateClient::find($data['invoice']->client_id);
        $data['invoice_no'] = $data['invoice']->invoice_no;
        $data['due_date'] = date('d-m-Y', strtotime(LogActivity::commonDateFromat($data['invoice']->due_date)));
        $data['inv_date'] = date('d-m-Y', strtotime(LogActivity::commonDateFromat($data['invoice']->inv_date)));
        //$data['city'] = $this->getCityName($data['advocate_client']->city_id);
        $data['subTotal'] = $data['invoice']->sub_total_amount;
        $data['tax_amount'] = $data['invoice']->tax_amount;
        $data['total_amount'] = $data['invoice']->total_amount;
        $data['json_to_array'] = array();
        $pdf = PDF::loadView('pdf.invoice', $data); 
        return $pdf->stream();
    }
    public function streamCasePDF(Request $request)
    {
        $id = $request['case_id'];
        $data['setting'] = GeneralSettings::where('id', "1")->first();

        $case = DB::table('court_cases AS case')
            ->leftJoin('advocate_clients AS ac', 'ac.id', '=', 'case.advo_client_id')
            ->leftJoin('case_types AS ct', 'ct.id', '=', 'case.case_types')
            ->leftJoin('case_types AS cst', 'cst.id', '=', 'case.case_sub_type')
            ->leftJoin('case_statuses AS s', 's.id', '=', 'case.case_status')
            ->leftJoin('court_types AS t', 't.id', '=', 'case.court_type')
            ->leftJoin('courts AS c', 'c.id', '=', 'case.court')
            ->leftJoin('judges AS j', 'j.id', '=', 'case.judge_type')
            ->select('case.id AS case_id', 'case.advo_client_id AS client_id', 'case.next_date', 'case.decision_date', 'case.nature_disposal', 'case.client_position', 'case.party_name', 'case.party_lawyer', 'case.case_number', 'case.act', 'case.priority',
                'case.court_no', 'case.judge_name', 'ct.case_type_name AS caseType', 'cst.case_type_name AS caseSubType',
                's.case_status_name', 't.court_type_name', 'c.court_name', 'j.judge_name AS judgeType', DB::raw('CONCAT(ac.first_name, " ", ac.middle_name, " " ,ac.last_name) AS full_name'), 'case.filing_number', 'case.filing_date', 'case.registration_number', 'case.registration_date',
                'case.remark', 'case.description', 'case.cnr_number', 'case.first_hearing_date',
                'case.police_station', 'case.fir_number', 'case.fir_date', 'case.act')
            ->where('case.id', $id)
            ->first();
        $data['associatedName'] = Admin::select('associated_name')->where('id', '1')->first();
        $data['case'] = $case;
        $getRespo = $this->getRespon($case->client_id, $case->case_id, $case->client_position);
        $data['petitioner_and_advocate'] = $getRespo['petitioner_and_advocate'];
        $data['respondent_and_advocate'] = $getRespo['respondent_and_advocate'];

        //case hestroy
        $getHistory = DB::table('case_logs AS cl')
            ->join('court_cases AS cc', 'cl.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'cl.judge_type', '=', 'j.id')
            ->join('case_statuses AS s', 'cl.case_status', '=', 's.id')
            ->select('cl.id AS case_log_id', 'cl.bussiness_on_date', 'cl.hearing_date', 'j.judge_name'
                , 's.case_status_name', 'cc.registration_number')
            ->where('cl.court_case_id', $id)
            ->get();

        $data['history'] = array();
        if (count($getHistory) > 0 && !empty($getHistory)) {
            $data['history'] = $getHistory;
        }
        //for transfer
        $transfer = DB::table('case_transfers AS ct')
            ->join('court_cases AS cc', 'ct.court_case_id', '=', 'cc.id')
            ->join('judges AS j', 'ct.from_judge_type', '=', 'j.id')
            ->join('judges AS jt', 'ct.to_judge_type', '=', 'jt.id')
            ->select('ct.id AS case_transfer_id', 'ct.transfer_date AS transferDate', 'ct.from_court_no', 'j.judge_name'
                , 'cc.registration_number', 'ct.to_court_no', 'jt.judge_name AS transferJudge')
            ->where('ct.court_case_id', $id)
            ->get();


        $data['transfer'] = array();
        if (count($transfer) > 0 && !empty($transfer)) {
            $data['transfer'] = $transfer;
        }

        $pdf = PDF::loadView('pdf.welcome', $data);
        $filename = time() . ".pdf";
        return $pdf->download($filename);
    }
    public function getRespon($client_id, $court_case_id, $client_position)
    {
        $client_single_name = AdvocateClient::select('first_name', 'middle_name', 'last_name')->find($client_id);
        $client_single = $client_single_name->first_name . ' ' . $client_single_name->middle_name . ' ' . $client_single_name->last_name;
        $admin = Admin::find(1);
        $clientPar = array();
        $clientPartiesInvoive = CasePartiesInvolves::where('court_case_id', $court_case_id)->get();
        if (count($clientPartiesInvoive) && !empty($clientPartiesInvoive)) {
            foreach ($clientPartiesInvoive as $key => $value) {
                $clientPar[$key]['party_name'] = $value['party_firstname'] . ' ' . $value['party_middlename'] . ' ' . $value['party_lastname'];
                if (empty($value['party_advocate'])) {
                    $clientPar[$key]['party_advocate'] = $admin->first_name . ' ' . $admin->last_name;
                } else {
                    $clientPar[$key]['party_advocate'] = $value['party_advocate'];
                }
            }
        }

        $mearge = array();
        $cli[0]['party_name'] = $client_single;
        $cli[0]['party_advocate'] = $admin->first_name . ' ' . $admin->last_name;

        if (!empty($clientPar) && count($clientPar) > 0) {
            $mearge = array_merge($cli, $clientPar);
        } else {
            $mearge = $cli;
        }

        $respondent = CasePartiesInvolves::select("party_name", "party_advocate")->where('court_case_id', $court_case_id)->get();
        if (count($respondent) && !empty($respondent)) {
            $second = collect($respondent)->toArray();
        }
        // $result=collect($case)->toArray();

        $PetitiAndRespo = array();
        if ($client_position == "Petitioner") {
            $result['petitioner_and_advocate'] = $mearge;
            $result['respondent_and_advocate'] = $second;
        } else {
            $result['petitioner_and_advocate'] = $second;
            $result['respondent_and_advocate'] = $mearge;
        }
        return $result;
    }

    public function uploadUserDocument(Request $request){
        try {
            $user_id = $request['user_id'];
            $user_doc = $request->file('user_document');
            $org_name  = $user_doc->getClientOriginalName();
	    $ext = $user_doc->getClientOriginalExtension() == '' ? 'png' : $user_doc->getClientOriginalExtension();
	    $unique_name = uniqid().'.'.$ext;
            $destination = 'storage/documents';
            $user_doc->move($destination, $unique_name );
            $thumbnail = $request->getSchemeAndHttpHost().'/storage/documents/'.$unique_name;
            DB::table('user_documents')->insert([
                'user_id'=> $user_id,
                'name' => $org_name,
                'url' => $thumbnail,
                'uploaded_on' => date('Y-m-d'),
            ]);
            $response = [
              'code'=>200,
                'status'=>'success'
            ];
            return response()->json($response,200);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function streamInvoicePaymentHistoryItem(Request $request){
        try {
            $iph_id = $request['iph_id'];
            $history = DB::table('payment_receiveds')->where('id',$iph_id)->first();
            $pdf = PDF::loadView('pdf.payment_history', ['history'=>$history]);
            $filename = time() . ".pdf";
            return $pdf->download($filename);
        }catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage()."#Line: ".$e->getLine(),
                'status'=>'failed'
            ];
            return response()->json($response,200);
        }
    }

    public function requestPayment(Request $request){
    	try{
		$invoice = $request['invoice'];
		$amount = $request['amount'];
		DB::table('request_payments')->insert([
			'invoice'=>$invoice,
			'amount'=>$amount,
		]);
		$response = [
			'code'=>200,
			'status'=>'success'
		];
		return response()->json($response,200);
	}catch(\Exception $e){
		$response = [
			'code'=>500,
			'message'=>$e->getMessage(),
			'status'=>'failed',
		];
		return response()->json($response,200);
	}
    }

    public function caseHistories($id){
        try {
            $response = [];
            $response['judgements'] = DB::table('case_judgements')
                ->where('case_id',$id)
                ->orderBy('cjid','DSC')
                ->get();
            $response['hearings'] = DB::table('case_hearings')
                ->where('case_id',$id)
                ->orderBy('hid','DSC')
                ->get();
            $response['levels'] = DB::table('case_levels')
                ->where('case_id',$id)
                ->orderBy('lid','DES')
                ->get();
            $response['execution'] = DB::table('case_executions')
                ->where('case_id',$id)
                ->first();
            return response()->json($response,200);
        } catch (\Exception $e) {
            $response = [
                'code'=>500,
                'message'=>$e->getMessage(),
                'status'=>'failed',
            ];
            return response()->json($response,200);
        }
    }

}
