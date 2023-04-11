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
            'id' => 1,
            'name' => 'TO DO',
        ]);
        DB::table('task_status')->insert([
            'id' => 2,
            'name' => 'IN PROGRESS',
        ]);
        DB::table('task_status')->insert([
            'id' => 3,
            'name' => 'DONE',
        ]);
    }
}
