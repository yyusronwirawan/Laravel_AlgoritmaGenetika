<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            "Pendidikan Agama",
            "Teknologi Informasi dan Komunikasi (TIK)",
            "Pendidikan Pancasila dan Kewarganegaraan (PPKN)",
            "Matematika",
            "Bahasa Indonesia",
            "Bahasa Inggris",
            "Ilmu Pengetahuan Alam (IPA)",
            "Ilmu Pengetahuan Sosial (IPS)",
            "Pendidikan Jasmani, Olahraga dan Kesehatan",
            "Bimbingan Konseling (BK)",
            "Seni Budaya dan Kerajinan (SBK)",
            "Prakarya",
        ];

        foreach ($courses as $course) {
            Course::create(['name' => ucfirst($course)]);
        }
    }
}
