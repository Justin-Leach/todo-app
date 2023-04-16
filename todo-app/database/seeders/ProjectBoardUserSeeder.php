<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectBoardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_board_user')->insert([
            'id' => 1,
            'user_id' => 1,
            'project_board_id' => 1,
        ]);
    }
}
