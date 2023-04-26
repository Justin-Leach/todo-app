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

    // Dropdown
    public $isOpen = false;
    public $options = null;

    protected $listeners = [
        'updateListProjectBoard' => 'updateListProjectBoard',
        'updateListBacklog' => 'updateListBacklog',
    ];

    public function mount()
    {
        $projectBoardID = 1; // TODO Find the current project board
        $this->projectBoard = ProjectBoard::find($projectBoardID);

        $queryBacklog = ProjectBoard::find($projectBoardID)->tasks()->where('status_id', '=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();
        $queryProjectBoard = ProjectBoard::find($projectBoardID)->tasks()->where('status_id', '!=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();

        $this->backlogItems = $queryBacklog;
        $this->numberBacklogItems = count($queryBacklog);

        $this->projectBoardItems = $queryProjectBoard;
        $this->numberProjectBoardItems = count($queryProjectBoard);

        $this->options = TaskStatus::all();
    }

    public function selectOptionProjectBoard($taskID, $optionID, $currentItems, $nameItems)
    {
        if ($currentItems !== "projectBoardItems" || $optionID === 1) {
            return $this->selectOption($taskID, $optionID, $currentItems, $nameItems);
        }
        return $this->selectOption($taskID, $optionID, $currentItems, $currentItems);
    }

    private function selectOption($taskID, $optionID, $currentItems, $nameItems)
    {
        $currentList = &$this->{$currentItems};

        $index = $currentList->search(function (Task $item) use ($taskID) {
            return $item->id === $taskID;
        });

        $item = $currentList->pull($index);
        $item->status_id = $optionID;

        $list = &$this->{$nameItems};

        $list->push($item);

        $this->updateTaskStatus($taskID, $optionID);
        $this->alertMessage('success', 'Task successfully updated!');
        $this->toggleDropdown();
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function updateListProjectBoard($taskID, $nameItems, $newStatus)
    {
        $this->moveTaskModal($taskID, $this->projectBoard->name, 'Backlog');

        $this->taskID = $taskID;
        $this->currentItems = "projectBoardItems";
        $this->nameItems = $nameItems;
        $this->newStatus = $newStatus;
    }

    public function updateListBacklog($taskID, $nameItems, $newStatus)
    {
        $this->moveTaskModal($taskID, 'Backlog', $this->projectBoard->name);

        $this->taskID = $taskID;
        $this->currentItems = "backlogItems";
        $this->nameItems = $nameItems;
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
        $currentList = &$this->{$this->currentItems};
        $taskID = $this->taskID;

        $index = $currentList->search(function (Task $item) use ($taskID) {
            return $item->id === $taskID;
        });

        $item = $currentList->pull($index);
        $item->status_id = $this->newStatus;

        $list = &$this->{$this->nameItems};
        $list->push($item);

        $this->updateTaskStatus($taskID, $this->newStatus);
        $this->alertMessage('success', 'Task successfully moved!');
        $this->moveTaskModal = false;
    }

    private function updateTaskStatus($taskID, $newStatus)
    {
        $task = Task::find($taskID);
        $task->status_id = $newStatus;
        $task->save();

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
