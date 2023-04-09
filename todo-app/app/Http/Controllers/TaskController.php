<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Task;

class TaskController extends Controller
{
    public function view()
    {
        return view("tasks.task");
    }

    public function show($taskID = null)
    {
        $task = Task::find($taskID);

        $this->authorize('update', $task);
        $this->authorize('delete', $task);

        return view("tasks.task-form", ['task' => $task, 'updateTask' => Task::TASK_UPDATED]);
    }

    public function create()
    {
        return view("tasks.task-form", ['task' => new Task(), 'updateTask' => Task::TASK_CREATED]);
    }
}
