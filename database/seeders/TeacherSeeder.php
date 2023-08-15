<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->count();
        for ($i=2; $i <= $users; $i++) {
            Teacher::create([
                'user_id'   => $i,
                'nip'       => $i.date('Ymd').date('His').$i,
                'employ'    => 'Guru',
                'phone'     => '+6285767113554',
            ]);
        }
    }
}
