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
        return Task::where('project_board_id', '=', $projectBoardID)
            ->where('status_id', '=', TaskStatus::TASK_STATUS_TO_DO_ID)
            ->orderBy('order')
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
        return Task::where('project_board_id', '=', $projectBoardID)
            ->where('status_id', '=', TaskStatus::TASK_STATUS_IN_PROGRESS_ID)
            ->orderBy('order')
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
        return Task::where('project_board_id', '=', $projectBoardID)
            ->where('status_id', '=', TaskStatus::TASK_STATUS_DONE_ID)
            ->orderBy('order')
            ->get();
    }

    public function getProjectBoardTask($projectBoardID)
    {
        return Task::where('project_board_id', '=', $projectBoardID)
            ->where('status_id', '!=', TaskStatus::TASK_STATUS_BACKLOG_ID)
            ->orderBy('status_id', 'desc')
            ->orderBy('order')
            ->get();
    }

    public function getBacklogTask($projectBoardID)
    {
        return Task::where('project_board_id', '=', $projectBoardID)
            ->where('status_id', '=', TaskStatus::TASK_STATUS_BACKLOG_ID)
            ->orderBy('order')
            ->get();
    }
}
