<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CourtCase;
use DB;
class ExecutionController extends Controller
{
    //
    public function getExecutions(){
        try{
            $cases = DB::table('court_cases')
            ->join('advocate_clients','advocate_clients.id','=','court_cases.advo_client_id')
            ->select(['court_cases.id','court_cases.case_number','court_cases.party_name','court_cases.exe_status','advocate_clients.first_name','advocate_clients.last_name'])
            ->get();
            return view('admin.executions.index',['cases'=>$cases]);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
    }
    public function updateExecution(Request $request){
        try{
            $case = $request['case_id'];
            $date = $request['exe_date'];
            $notes = $request['exe_notes'];
            $record = DB::table('case_executions')->insertGetId([
                'case_id'=>$case,
                'exe_date'=>$date,
                'exe_notes'=>$notes,
            ]);
            $rcase = CourtCase::find($case);
            $rcase->exe_status = 1;
            $rcase->save();
            return redirect('/admin/executions/view/'.$record);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
    }

    public function viewExecution(Request $request){
        try{
            $eid = $request['id'];
            $record = DB::table('case_executions')
            ->where('case_id',$eid)
            ->orWhere('eid',$eid)
            ->first();
            return view('admin.executions.view',['record'=>$record]);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
    }

    public function editExecution(Request $request){
        try {
            $eid = $request['id'];
            $date = $request['exe_date'];
            $notes = $request['exe_notes'];
            DB::table('case_executions')
            ->where('eid',$eid)
            ->update([
                'exe_date'=>$date,
                'exe_notes'=>$notes,
            ]);
            return redirect('/admin/executions/view/'.$eid);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
        
    }
}
