<?php

namespace App\Http\Controllers\Admin;

use App\Timeslot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class TimeslotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $timeslots = DB::table('timeslots')
        ->join('admins','admins.id','=','timeslots.lawyer')
        ->select(['tsid','first_name','last_name','date','start_time','end_time'])
        ->get();
        return view('admin.timeslots.index',['timeslots'=>$timeslots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lawyers = DB::table('admins')->select(['id','first_name','last_name'])->get();
        return view('admin.timeslots.create',['lawyers'=>$lawyers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $lawer = $request['lawyer'];
            $date = $request['date'];
            $start_time = $request['start_time'];
	    $end_time = $request['end_time'];
            $exist = DB::table("timeslots")
		    ->where('lawyer',$lawer)
		    ->where('date',$date)
		    ->where('start_time',$start_time)
		    ->where('end_time',$end_time)
		    ->get();
	    if(count($exist) > 0){
	    	return response()->json([
			'success'=>'duplicate',
			'code'=>500,
			'error'=>'duplicate_entry',
		],200);
	    }else{
            	DB::table('timeslots')->insert(
                	[
                    	'lawyer'=>$lawer,
                    	'date'=>$date,
                    	'start_time'=>$start_time,
                    	'end_time'=>$end_time
                	]
		);
		return response()->json([
			'success'=>true,
			'code'=>200,
		],200);
	    }
        } catch (\Exception $e) {
            return [
                'success'=>false,
		'code'=>500,
		'msg'=>$e->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function show(Timeslot $timeslot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeslot $timeslot)
    {
        //
        return view('admin.timeslots.edit',['timeslot'=>$timeslot]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeslot $timeslot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timeslot  $timeslot
     * @return \Illuminate\Http\Response
     */
    public function destroy($tid)
    {
        //
        try {
            DB::table('timeslots')->where('tsid',$tid)->delete();
            return response()->json(['success'=>true], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
