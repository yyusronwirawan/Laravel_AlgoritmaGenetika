<?php

namespace App\Http\Controllers\Admin;

use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']  = 'Time Schedule Page';
        $data['time']   = TimeSchedule::all();
        return view('admin.time.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit']   = false;
        $data['title']  = 'Time Schedule Page';
        return view('admin.time.addEdit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->time_start, $request->time_end);
        $data               = new TimeSchedule();
        $data->time_start   = $request->time_start;
        $data->time_end     = $request->time_end;
        $data->save();
        return redirect()->route('admin.data_times.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['edit']   = true;
        $data['title']  = 'Time Schedule Page';
        $data['time']   = TimeSchedule::find($id);
        return view('admin.time.addEdit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data               = TimeSchedule::find($id);
        $data->time_start   = $request->time_start;
        $data->time_end     = $request->time_end;
        $data->save();
        return redirect()->route('admin.data_times.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = TimeSchedule::find($id);
        $data->delete();
        return redirect()->route('admin.data_times.index');
    }
}
