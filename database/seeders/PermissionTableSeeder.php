<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // dashboard
            'C-dashboard',
            'R-dashboard',
            'U-dashboard',
            'D-dashboard',

            // data-teacher
            'C-data-teacher',
            'R-data-teacher',
            'U-data-teacher',
            'D-data-teacher',

            // data-day-schedule
            'C-data-day-schedule',
            'R-data-day-schedule',
            'U-data-day-schedule',
            'D-data-day-schedule',

            // data-time-schedule
            'C-data-time-schedule',
            'R-data-time-schedule',
            'U-data-time-schedule',
            'D-data-time-schedule',

            // data-room
            'C-data-room',
            'R-data-room',
            'U-data-room',
            'D-data-room',

            // data-classroom
            'C-data-classroom',
            'R-data-classroom',
            'U-data-classroom',
            'D-data-classroom',

            // data-course
            'C-data-course',
            'R-data-course',
            'U-data-course',
            'D-data-course',

            // data-course-schedule
            'C-data-course-schedule',
            'R-data-course-schedule',
            'U-data-course-schedule',
            'D-data-course-schedule',

            // data-pso
            'C-data-pso',
            'R-data-pso',
            'U-data-pso',
            'D-data-pso',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
