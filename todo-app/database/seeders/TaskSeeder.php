<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'id' => 1,
            'title' => 'Task 1',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 2,
            'title' => 'Task 2',
            'priority' => '2',
            'importance' => '2',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 3,
            'title' => 'Task 3',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_IN_PROGRESS_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 4,
            'title' => 'Task 4',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_DONE_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 5,
            'title' => 'Task 5',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 6,
            'title' => 'Task 6',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 7,
            'title' => 'Task 7',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 8,
            'title' => 'Task 8',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 9,
            'title' => 'Task 9',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 10,
            'title' => 'Task 10',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 11,
            'title' => 'Task 11',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
        DB::table('tasks')->insert([
            'id' => 12,
            'title' => 'Task 12',
            'priority' => '1',
            'importance' => '1',
            'description' => 'aaaaaa',
            'status_id' => TaskStatus::TASK_STATUS_TO_DO_ID,
            'user_id' => 1,
            'project_board_id' => 1
        ]);
    }
}