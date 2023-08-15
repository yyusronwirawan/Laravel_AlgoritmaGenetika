<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = "courses";
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher');
    }

    public function courseTeacher()
    {
        return $this->belongsToMany(CourseTeacher::class, 'teacher_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}
