<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['role_name' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
            ['role_name' => 'student', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}

