<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\User;
use Illuminate\Validation\Rules;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']          = 'Teacher Page';
        $data['teacher']        = Teacher::with(['user','course'])->get();
        return view('admin.teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit']       = false;
        $data['title']      = 'Teacher Page';
        $data['courses']    = Course::all();
        $data['user']       = User::where('id','!=',1)->get();
        return view('admin.teacher.addEdit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user                    = new User();
        $user->name              = $request->name;
        $user->email             = $request->email;
        $user->password          = bcrypt($request->password);
        $user->email_verified_at = now();
        $user->remember_token    = Str::random(10);
        $user->save();

        $teacher            = new Teacher();
        $teacher->user_id   = $user->id;
        $teacher->nip       = empty($request->nip) ? NULL : $request->nip;
        $teacher->employ    = 'Guru';
        $teacher->phone     = $this->gantiformat($request->phone);
        $teacher->save();

        $ct                 = new CourseTeacher();
        $ct->course_id      = $request->course_id;
        $ct->teacher_id     = $user->id;
        $ct->save();
        return redirect()->route('admin.data_teachers.index');
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
        $data['edit']       = true;
        $data['title']      = 'Teacher Page';
        $data['user']       = User::where('id','!=',1)->get();
        $data['teacher']    = Teacher::with('user')->where('id',$id)->first();
        $data['course']     = CourseTeacher::with('course','teacher')->where('teacher_id',$data['teacher']->id)->first();
        $data['courses']    = Course::where('id','!=',$data['course']->course_id)->get();
        return view('admin.teacher.addEdit', $data);
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
        $teacher            = Teacher::where('user_id',$request->user_id)->first();
        $teacher->user_id   = $request->user_id;
        $teacher->nip       = $request->nip;
        $teacher->employ    = 'Guru';
        $teacher->phone     = $this->gantiformat($request->phone);
        $teacher->save();

        $user                    = User::where('id',$request->user_id)->first();
        $user->name              = $request->name;
        if (!empty($request->email)) {
            $request->validate([
                'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->email         = $request->email;
        }
        if (!empty($request->password)) {
            $request->validate([
                'password'       => ['nullable', 'confirmed', Rules\Password::defaults()],
            ]);
            $user->password      = bcrypt($request->password);
        }
        $user->email_verified_at = now();
        $user->remember_token    = Str::random(10);
        $user->save();

        if (!empty($request->course_id)) {
            $ct                 = CourseTeacher::where('teacher_id',$teacher->id)->first();
            $ct->course_id      = $request->course_id;
            $ct->teacher_id     = $teacher->id;
            $ct->save();
        }
        return redirect()->route('admin.data_teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data   = Teacher::where('user_id',$request->user_id);
        $data->delete();
        $user   = User::find($request->user_id);
        $user->delete();
        $ct     = CourseTeacher::where('teacher_id',$request->user_id)->get();
        $ct->delete();
        return redirect()->route('admin.data_teachers.index');
    }

    public function gantiformat($nomorhp) {
        $nomorhp = trim($nomorhp);
        $nomorhp = strip_tags($nomorhp);
        $nomorhp = str_replace(" ","",$nomorhp);
        $nomorhp = str_replace("(","",$nomorhp);
        $nomorhp = str_replace(".","",$nomorhp);

        if(!preg_match('/[^+0-9]/',trim($nomorhp))){
            if(substr(trim($nomorhp), 0, 3) == '+62'){
                $nomorhp = trim($nomorhp);
            }
            elseif(substr($nomorhp, 0, 1) == '0'){
                $nomorhp = '+62'.substr($nomorhp, 1);
            }
        }
        return $nomorhp;
    }
}
