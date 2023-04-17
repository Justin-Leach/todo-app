<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;
use App\Models\ProjectBoard;
use App\Repositories\ProjectBoardRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProjectBoardBacklog extends Component
{
    public $backlogItems;
    public $projectBoardItems;

    public $numberBacklogItems = 0;
    public $numberProjectBoardItems = 0;

    public function mount()
    {
        $projectBoardID = 1; // TODO Find the current project board

        $queryBacklog = ProjectBoard::find($projectBoardID)->tasks()->where('status_id', '=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();
        $queryProjectBoard = ProjectBoard::find($projectBoardID)->tasks()->where('status_id', '!=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();

        $this->backlogItems = $queryBacklog;
        $this->numberBacklogItems = count($queryBacklog);

        $this->projectBoardItems = $queryProjectBoard;
        $this->numberProjectBoardItems = count($queryProjectBoard);
    }

    public function render()
    {
        return view('livewire.project-board-backlog');
    }
}
