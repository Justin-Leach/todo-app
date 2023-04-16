<?php

namespace App\Repositories;

use App\Models\ProjectBoard;
use Exception;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectBoardRepository
{
    /**
     *
     *
     * @return
     */
    public function getActiveProjectUser()
    {
        return ProjectBoard::where('owner_id', '=', auth()->user()->id)
            ->where('active', '=', true)
            // ->where('expired_date', '<') // Futur
            ->first();
    }

    /**
     * Get project board task of the todo list
     *
     * @return
     */
    public function getProjectTaskTodo($projectBoardID)
    {
        return ProjectBoard::find($projectBoardID)->tasks()
            ->where('status_id', '=', TaskStatus::TASK_STATUS_TO_DO_ID)
            ->get();
    }

    /**
     * Get project board task of the in progress list
     *
     * @param int $projectBoardID

     * @return
     */
    public function getProjectTaskInProgress($projectBoardID)
    {
        return ProjectBoard::find($projectBoardID)->tasks()
            ->where('status_id', '=', TaskStatus::TASK_STATUS_IN_PROGRESS_ID)
            ->get();
    }

    /**
     * Get project board task of the done list
     *
     * @param int $projectBoardID
     *
     * @return
     */
    public function getProjectTaskDone($projectBoardID)
    {
        return ProjectBoard::find($projectBoardID)->tasks()
            ->where('status_id', '=', TaskStatus::TASK_STATUS_DONE_ID)
            ->get();
    }
}
