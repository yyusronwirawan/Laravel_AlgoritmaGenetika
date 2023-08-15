<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Models\CourseSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title']      = 'Dashboard Teacher';
        $data['schedule']   = CourseSchedule::where('teacher_id',Auth::user()->id)->get()->count();
        return view('teacher.dashboard', $data);
    }
}
