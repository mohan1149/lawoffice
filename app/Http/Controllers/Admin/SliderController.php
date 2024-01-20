<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::all();
        return view('admin.sliders.index',['sliders'=>$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sliders.create');
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
            $published = $request['publish'] == 'on' ? 1 : 0;
            $image = $request->file('image');
            $org_name  = $image->getClientOriginalName();
            $unique_name  = uniqid().'.'.$image->getClientOriginalExtension();
            $destination = 'storage/sliders';
            $image->move($destination, $unique_name );
            $thumbnail = $request->getSchemeAndHttpHost().'/storage/sliders/'.$unique_name;
            
            DB::table('sliders')->insert([
                'name' => $org_name,
                'image' => $thumbnail,
                'published'=>$published,
                'created_on' => date('Y-m-d'),
            ]);
            return redirect('/admin/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        return view('admin.sliders.edit',['slider'=>$slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $published = $request['publish'] == 'on' ? 1 : 0;
        $image = $request->file('image');
        if($image != null || $image != ''){
            $org_name  = $image->getClientOriginalName();
            $unique_name  = uniqid().'.'.$image->getClientOriginalExtension();
            $destination = 'storage/sliders';
            $image->move($destination, $unique_name );
            $thumbnail = $request->getSchemeAndHttpHost().'/storage/sliders/'.$unique_name;
            $slider->name = $org_name;
            $slider->image = $thumbnail;
        }
        $slider->published = $published;
        $slider->save();
        return redirect('/admin/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        try {
            $slider->delete();
            return response()->json(['success'=>true], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
}
