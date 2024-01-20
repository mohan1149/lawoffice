<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class JudgeTimeLowController extends Controller
{
    //

    public function index(){
        try {
            $times = DB::table('tudgement_time_lows as laws')
            ->leftJoin('case_types as types','laws.case_type','=','types.id')
            ->select(['laws.jtlid','laws.number_days','laws.case_level','types.case_type_name'])
            ->get();
            return view('admin.time_lows.index',['times'=>$times]);
        } catch (\Exception $e) {
            return abort(500,'ISE');
        }
    }

    public function create(){
        try {
            $case_types = DB::table('case_types')->get()->pluck('case_type_name','id');
            return view('admin.time_lows.create',['case_types'=>$case_types]);
        } catch (\Exception $e) {
            return abort(500,'ISE');
        }
    }

    public function store(Request $request){
        try {
            $days = $request['days'];
            $case_level = $request['case_level'];
            DB::table('tudgement_time_lows')->insert([
                'number_days'=>$days,
                'case_level'=>$case_level,
                'case_type'=>$request['case_type'],
            ]);
            return redirect('/admin/judge-time-low');
        } catch (\Exception $e) {
            return abort(500,'ISE');
        }
    }

    public function destroy($id){
        try {
            DB::table('tudgement_time_lows')->where('jtlid',$id)->delete();
            return response()->json(['success'=>true], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
