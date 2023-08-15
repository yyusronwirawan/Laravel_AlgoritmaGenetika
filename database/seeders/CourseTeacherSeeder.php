<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseTeacher;
use Illuminate\Database\Seeder;

class CourseTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseTeacher = 12;
        for ($i=1; $i <= $courseTeacher; $i++) {
            CourseTeacher::create([
                'course_id'     => $i,
                'teacher_id'    => $i+1,
            ]);
        }
    }
}
