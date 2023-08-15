<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PermissionTableSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            DayScheduleSeeder::class,
            TimeScheduleSeeder::class,
            RoomSeeder::class,
            ClassroomSeeder::class,
            CourseSeeder::class,
            CourseTeacherSeeder::class,
        ]);
    }
}
