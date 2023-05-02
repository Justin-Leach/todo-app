<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;
use App\Models\ProjectBoard;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProjectBoardRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProjectBoardBacklog extends Component
{
    use LivewireAlert;

    public ProjectBoard $projectBoard;

    public $backlogItems;
    public $projectBoardItems;

    public $numberBacklogItems = 0;
    public $numberProjectBoardItems = 0;

    // Modal
    public $moveTaskModal = false;
    public $selectedTaskTitle = "";
    public $moveTaskTaskText1 = "";
    public $moveTaskTaskText2 = "";

    // Modal Confirmed
    public $taskID;
    public $currentItems;
    public $nameItems;
    public $newStatus;
    public $list;

    // Dropdown
    public $isOpen = false;
    public $options = null;

    protected $listeners = [
        'updateListProjectBoard' => 'updateListProjectBoard',
        'updateListProjectBoardOrder' => 'updateListProjectBoardOrder',
        'updateListBacklog' => 'updateListBacklog',
        'updateListBacklogOrder' => 'updateListBacklogOrder'
    ];

    public function mount()
    {
        $projectBoardID = 1; // TODO Find the current project board
        $this->projectBoard = ProjectBoard::find($projectBoardID);

        $queryProjectBoard = (new ProjectBoardRepository)->getProjectBoardTask($this->projectBoard->id);
        $this->projectBoardItems = $queryProjectBoard;
        $this->numberProjectBoardItems = count($queryProjectBoard);

        $queryBacklog = (new ProjectBoardRepository)->getBacklogTask($this->projectBoard->id);
        $this->backlogItems = $queryBacklog;
        $this->numberBacklogItems = count($queryBacklog);

        $this->options = TaskStatus::all();
    }

    public function selectOption($taskID, $optionID)
    {
        $this->updateTaskOrder($taskID);
        $this->updateTaskStatus($taskID, $optionID);

        $this->alertMessage('success', 'Task successfully updated!');
        $this->toggleDropdown();
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function updateListProjectBoard($taskID, $newStatus)
    {
        $this->moveTaskModal($taskID, $this->projectBoard->name, 'Backlog');

        $this->taskID = $taskID;
        $this->newStatus = $newStatus;
    }

    public function updateListBacklog($taskID, $newStatus)
    {
        $this->moveTaskModal($taskID, 'Backlog', $this->projectBoard->name);

        $this->taskID = $taskID;
        $this->newStatus = $newStatus;
    }

    private function moveTaskModal($taskID, $text1, $text2)
    {
        $this->selectedTaskTitle = Task::find($taskID)->title;
        $this->moveTaskTaskText1 = $text1;
        $this->moveTaskTaskText2 = $text2;
        $this->moveTaskModal = true;
    }

    public function moveTaskProjectBoard()
    {
        $this->updateTaskOrder($this->taskID);
        $this->updateTaskStatus($this->taskID, $this->newStatus);
        $this->alertMessage('success', 'Task successfully moved!');
        $this->moveTaskModal = false;
    }

    public function updateListProjectBoardOrder($list)
    {
        $cptTodo = 0;
        $cptInProgress = 0;
        $cptDone = 0;

        foreach ($list as $key => $value) {
            if (intval(explode("-", $value)[1]) === 2) {
                $task = Task::find(intval(explode("-", $value)[2]));
                $task->order = $cptTodo;
                $task->save();
                $cptTodo++;
            }

            if (intval(explode("-", $value)[1]) === 3) {
                $task = Task::find(intval(explode("-", $value)[2]));
                $task->order = $cptInProgress;
                $task->save();
                $cptInProgress++;
            }

            if (intval(explode("-", $value)[1]) === 4) {
                $task = Task::find(intval(explode("-", $value)[2]));
                $task->order = $cptDone;
                $task->save();
                $cptDone++;
            }
        }

        $this->projectBoardItems = (new ProjectBoardRepository)->getProjectBoardTask($this->projectBoard->id);
    }

    public function updateListBacklogOrder($list)
    {
        foreach ($list as $key => $value) {
            $task = Task::find(intval(explode("-", $value)[2]));
            $task->order = $key;
            $task->save();
        }

        $this->backlogItems = (new ProjectBoardRepository)->getBacklogTask($this->projectBoard->id);
    }

    private function updateTaskOrder($taskID)
    {
        $task = Task::find($taskID);

        // Update previous list order
        $tasks = Task::where('project_board_id', '=', $this->projectBoard->id)
            ->where('status_id', '=', $task->status_id)
            ->where('order', '>', $task->order)
            ->get();

        foreach ($tasks as $t) {
            $t->order = $t->order - 1;
            $t->save();
        }
    }

    private function updateTaskStatus($taskID, $newStatus)
    {
        $task = Task::find($taskID);
        $task->status_id = $newStatus;

        $latestTask = Task::where('tasks.project_board_id', '=', $this->projectBoard->id)
            ->where('tasks.status_id', '=', $newStatus)
            ->orderBy('order', 'DESC')
            ->latest()
            ->first();

        $task->order = $latestTask ? $latestTask->order + 1 : 0;
        $task->save();

        $this->projectBoardItems = (new ProjectBoardRepository)->getProjectBoardTask($this->projectBoard->id);
        $this->backlogItems = (new ProjectBoardRepository)->getBacklogTask($this->projectBoard->id);

        $this->updateCountTask();
    }

    private function updateCountTask()
    {
        $this->numberBacklogItems = count($this->backlogItems);
        $this->numberProjectBoardItems = count($this->projectBoardItems);
    }

    private function alertMessage($status, $message)
    {
        $this->alert($status, $message, [
            'toast' => true,
            'timerProgressBar' => true,
            'timer' => '2000',
        ]);
    }

    public function render()
    {
        return view('livewire.project-board-backlog');
    }
}
