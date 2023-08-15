<?php

namespace Database\Seeders;

use App\Models\TimeSchedule;
use Illuminate\Database\Seeder;

class TimeScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TimeSchedule::create([
        //     'time_start'    => '07:30:00',
        //     'time_end'      => '08:10:00',
        //     'time_count'    => '40 menit',
        // ]);
        TimeSchedule::create([
            'time_start'    => '08:10:00',
            'time_end'      => '08:50:00',
            'time_count'    => '40 menit',
        ]);
        TimeSchedule::create([
            'time_start'    => '08:50:00',
            'time_end'      => '09:30:00',
            'time_count'    => '40 menit',
        ]);
        TimeSchedule::create([
            'time_start'    => '10:00:00',
            'time_end'      => '10:40:00',
            'time_count'    => '40 menit',
        ]);
        TimeSchedule::create([
            'time_start'    => '10:40:00',
            'time_end'      => '11:20:00',
            'time_count'    => '40 menit',
        ]);
        TimeSchedule::create([
            'time_start'    => '11:20:00',
            'time_end'      => '12:00:00',
            'time_count'    => '40 menit',
        ]);
        // TimeSchedule::create([
        //     'time_start'    => '12:40:00',
        //     'time_end'      => '13:20:00',
        //     'time_count'    => '40 menit',
        // ]);
        TimeSchedule::create([
            'time_start'    => '13:20:00',
            'time_end'      => '14:00:00',
            'time_count'    => '40 menit',
        ]);
    }
}
