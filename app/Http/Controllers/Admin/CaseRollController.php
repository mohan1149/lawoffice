<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
class CaseRollController extends Controller
{
    //
    public function getCaseRoll(Request $request){
        try {
            $case_types = DB::table('case_types')->get()->pluck('case_type_name','id');
            $courts = DB::table('courts')->get()->pluck('court_name','id');
            $filter_data= [
                'types'=>$case_types,
                'courts'=>$courts,
            ];
            $cases = $this->filterRoll($request);
            if($request['pdf']!=""){
                return $this->pdfRoll($cases);
            }else{
                return view('admin.roll.index',['filter_data'=>$filter_data,'cases'=>$cases]);
            }
        } catch (\Exception $e) {
            return abort(500,"IES");
        }
    }
    public function filterRoll(Request $request){
        try {
            $case_number = $request['case_number'];
            $case_type = $request['case_type'];
            $case_level = $request['case_level'];
            $start_date = $request['start_date'];
            $end_date = $request['end_date'];
            $priority = $request['priority'];
            $court = $request['court'];
            $exe_status = $request['exe_status'];
            $query = DB::table('court_cases as case')
            ->join('advocate_clients as client','client.id','=','case.advo_client_id')
            ->select([
                'case.case_number',
                'case.priority',
                'client.first_name',
                'client.last_name',
                'case.next_date',
                'case.priority',
                'case.client_position',
                'case.case_status',
                'case.judge_type',
                'case.case_sub_type',
                'case.exe_status',
                'case.notice_status',
                'case.case_level'
            ]);
            $query->when($case_number!='',function($q){
                return $q->where('case.case_number',request('case_number'));
            });
            $query->when($case_type!= 0,function($q){
                return $q->where('case.case_sub_type',request('case_type'));
            });
            $query->when($case_level!= '',function($q){
                return $q->where('case.case_level',request('case_level'));
            });
            $query->when($priority!= 0,function($q){
                return $q->where('case.priority',request('priority'));
            });
            $query->when($court!= 0,function($q){
                return $q->where('case.court',request('court'));
            });
            $query->when($exe_status!= 2 && $exe_status!="",function($q){
                return $q->where('case.exe_status',request('exe_status'));
            });
            $query->when($start_date!= "" && $end_date !=="",function($q){
                return $q->whereBetween('case.next_date',[request('start_date'),request('end_date')]);
            });
            return $query->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function pdfRoll($cases){
        try {
            $pdf = PDF::loadView('admin.roll.pdf',['cases'=>$cases]);
            return $pdf->stream();
        } catch (\Exception $e) {
            return abort(500,"IES");
        }
    }
}
