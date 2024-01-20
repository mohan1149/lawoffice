<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\CourtCase;
class NoticeController extends Controller
{
    //
    public function getNotices(){
        try{
            $cases = DB::table('court_cases')
            ->join('advocate_clients','advocate_clients.id','=','court_cases.advo_client_id')
            ->select(['court_cases.id','court_cases.case_number','court_cases.party_name','court_cases.notice_status','advocate_clients.first_name','advocate_clients.last_name'])
            ->get();
            return view('admin.notices.index',['cases'=>$cases]);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
    }
    public function updateNotice(Request $request){
        try{
            $case = $request['case_id'];
            $date = $request['notice_date'];
            $notes = $request['notice_notes'];
            $record = DB::table('case_notices')->insertGetId([
                'case_id'=>$case,
                'notice_date'=>$date,
                'notice_notes'=>$notes,
            ]);
            $rcase = CourtCase::find($case);
            $rcase->notice_status = 1;
            $rcase->save();
            return redirect('/admin/notices/view/'.$record);
        }catch(\Exception $e){
            return $e->getMessage();
            return abort(500,"Intrnal Server Error");
        }
    }

    public function viewNotice(Request $request){
        try{
            $eid = $request['id'];
            $record = DB::table('case_notices')
                ->where('nid',$eid)
                ->orWhere('case_id',$eid)
                ->first();
            return view('admin.notices.view',['record'=>$record]);
        }catch(\Exception $e){
            return abort(500,"Intrnal Server Error");
        }
    }
}
