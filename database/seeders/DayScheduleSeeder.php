<?php

namespace Database\Seeders;

use App\Models\DaySchedule;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DayScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            "senin",
            "selasa",
            "rabu",
            "kamis",
            "jum'at",
            "sabtu",
            "minggu",
        ];

        foreach ($days as $day) {
            DaySchedule::create(['name' => Str::upper($day)]);
        }
    }
}
