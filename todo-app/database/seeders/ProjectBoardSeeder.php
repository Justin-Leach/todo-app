<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_board')->insert([
            'id' => 1,
            'name' => 'Project NASA',
            'active' => true,
            'owner_id' => 1,
            'expired_at' => Carbon::now()->addDays(3),
            'created_at' => Carbon::now()
        ]);
        // DB::table('project_board')->insert([
        //     'id' => 2,
        //     'name' => 'Project Space X',
        //     'active' => false,
        //     'owner_id' => 1,
        // ]);
    }
}
