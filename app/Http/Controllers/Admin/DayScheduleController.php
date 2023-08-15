<?php

namespace App\Http\Controllers\Admin;

use App\Models\DaySchedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DayScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']  = 'Day Schedule Page';
        $data['day']    = DaySchedule::all();
        return view('admin.day.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit']   = false;
        $data['title']  = 'Day Schedule Page';
        return view('admin.day.addEdit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data       = new DaySchedule();
        $data->name = Str::upper($request->name);
        $data->save();
        return redirect()->route('admin.data_days.index');
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
        $data['title']  = 'Day Schedule Page';
        $data['day']    = DaySchedule::find($id);
        return view('admin.day.addEdit', $data);
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
        $data       = DaySchedule::find($id);
        $data->name = Str::upper($request->name);
        $data->save();
        return redirect()->route('admin.data_days.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data   = DaySchedule::find($id);
        $data->delete();
        return redirect()->route('admin.data_days.index');
    }
}
