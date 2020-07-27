<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'loan_days' => 4,
            'color_name' => 'orange',
            'side_color' => 'orange lighten-1',
            'top_color'=> 'orange',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);        
    }
}
