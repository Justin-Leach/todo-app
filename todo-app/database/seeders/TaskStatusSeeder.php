<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_status')->insert([
            'id' => TaskStatus::TASK_STATUS_BACKLOG_ID,
            'name' => 'BACKLOG',
        ]);
        DB::table('task_status')->insert([
            'id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'name' => 'TO DO',
        ]);
        DB::table('task_status')->insert([
            'id' => TaskStatus::TASK_STATUS_IN_PROGRESS_ID,
            'name' => 'IN PROGRESS',
        ]);
        DB::table('task_status')->insert([
            'id' => TaskStatus::TASK_STATUS_DONE_ID,
            'name' => 'DONE',
        ]);
    }
}
