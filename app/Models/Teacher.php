<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "teachers";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->hasMany(CourseTeacher::class, 'course_id');
    }

    public function courseTeacher()
    {
        return $this->belongsToMany(CourseTeacher::class, 'course_id');
    }
}
