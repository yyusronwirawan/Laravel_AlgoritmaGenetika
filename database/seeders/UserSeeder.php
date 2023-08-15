<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'              => 'Administrator',
            'email'             => 'admin@test.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);
        $roleAdmin = Role::create(['name' => 'admin']);
        $permissionsAdmin = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissionsAdmin);
        $admin->assignRole([$roleAdmin->id]);

        $userNo = 12;
        $roleUser = Role::create(['name' => 'teacher']);
        $permissions = [
            // dashboard
            'C-dashboard',
            'R-dashboard',
            'U-dashboard',
            'D-dashboard',

            // data-course-schedule
            'C-data-course-schedule',
            'R-data-course-schedule',
            'U-data-course-schedule',
            'D-data-course-schedule',
        ];
        $names = [
            1  => 'Dra Huznia',
            2  => 'Marwati S.Kom',
            3  => 'Kamidi S.Pd',
            4  => 'Subkhan S.Pd',
            5  => 'Dewi Jahro S.Pd',
            6  => 'Siti Suryani S.Pd',
            7  => 'Akhmad Muzakir M.Pd',
            8  => 'Kartini M.Pd',
            9  => 'Reza Maulana S.Pd',
            10 => 'Nurkhayati S.Pd',
            11 => 'Sujarwo S.Pd',
            12 => 'Siti Subaidah S.Pdl',
        ];
        $roleUser->syncPermissions($permissions);
        for ($i=1; $i <= $userNo; $i++) {
            $user = User::create([
                'name'              => $names[$i],
                'email'             => 'teacher'.$i.'@test.com',
                'password'          => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]);
            $user->assignRole([$roleUser->id]);
        }
    }
}
