<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\TaskStatusSeeder;
use Database\Seeders\ProjectBoardSeeder;
use Database\Seeders\ProjectBoardUserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TaskStatusSeeder::class,
            ProjectBoardSeeder::class,
            ProjectBoardUserSeeder::class,
            TaskSeeder::class,
        ]);
    }
}
