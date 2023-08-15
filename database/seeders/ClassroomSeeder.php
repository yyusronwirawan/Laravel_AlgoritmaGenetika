<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $classrooms = [
        //     "VI A",
        //     "VI B",
        //     "VII A",
        //     "VII B",
        //     "VIII A",
        //     "VIII B",
        //     // "VI",
        //     // "VII",
        //     // "VIII",
        // ];

        // foreach ($classrooms as $day) {
        //     Classroom::create([
        //         'room_id'   => 1,
        //         'name'      => Str::upper($day),
        //     ]);
        // }

        Classroom::create([
            'room_id'   => 1,
            'name'      => Str::upper('VI A'),
        ]);

        Classroom::create([
            'room_id'   => 2,
            'name'      => Str::upper('VI B'),
        ]);

        Classroom::create([
            'room_id'   => 3,
            'name'      => Str::upper('VII A'),
        ]);

        // Classroom::create([
        //     'room_id'   => 4,
        //     'name'      => Str::upper('VII B'),
        // ]);

        // Classroom::create([
        //     'room_id'   => 5,
        //     'name'      => Str::upper('VIII A'),
        // ]);

        // Classroom::create([
        //     'room_id'   => 6,
        //     'name'      => Str::upper('VIII B'),
        // ]);
    }
}
