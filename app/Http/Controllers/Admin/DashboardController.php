<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\DaySchedule;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\CourseSchedule;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title']      = 'Dashboard Admin';
        $data['time']       = TimeSchedule::all()->count();
        $data['day']        = DaySchedule::where('id','!=',6)->where('id','!=',7)->get()->count();
        $data['room']       = Room::all()->count();
        $data['classroom']  = Classroom::all()->count();
        $data['course']     = Course::all()->count();
        $data['schedule']   = CourseSchedule::all()->count();
        $data['teacher']    = Teacher::where('user_id','!=',1)->get()->count();
        return view('admin.dashboard', $data);
    }
}
