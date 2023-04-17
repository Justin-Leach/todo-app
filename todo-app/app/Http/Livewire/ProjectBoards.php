<?php

namespace App\Http\Livewire;

use App\Models\ProjectBoard;
use App\Models\Task;
use Livewire\Component;
use App\Repositories\ProjectBoardRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProjectBoards extends Component
{
    use LivewireAlert;

    public $projectBoard;
    public $projectSelectedExpired;

    public $todoItems;
    public $inProgressItems;
    public $doneItems;

    public $numberTodoItems = 0;
    public $numberInProgressItems = 0;
    public $numberDoneItems = 0;

    protected $listeners = [
        'updateListTodo' => 'updateListTodo',
        'updateListInProgress' => 'updateListInProgress',
        'updateListDone' => 'updateListDone',
        'createTaskModal' => 'createTaskModal',
        'updateTaskModal' => 'updateTaskModal',
        'deleteTaskModal' => 'deleteTaskModal', // the elements in the last get automatically remove

        // Project board
        'updateProjectBoardModal' => 'updateProjectBoard',
    ];

    public function mount()
    {
        $this->projectBoard = (new ProjectBoardRepository())->getActiveProjectUser();

        $this->projectSelectedExpired = $this->projectBoard->exipred();

        $queryTaskTodo = (new ProjectBoardRepository)->getProjectTaskTodo($this->projectBoard->id);
        $queryTaskInProgress = (new ProjectBoardRepository)->getProjectTaskInProgress($this->projectBoard->id);
        $queryTaskDone = (new ProjectBoardRepository)->getProjectTaskDone($this->projectBoard->id);

        $this->todoItems = $queryTaskTodo;
        $this->numberTodoItems = count($queryTaskTodo);

        $this->inProgressItems = $queryTaskInProgress;
        $this->numberInProgressItems = count($queryTaskInProgress);

        $this->doneItems = $queryTaskDone;
        $this->numberDoneItems = count($queryTaskDone);
    }

    public function updateListTodo($taskID, $nameItems, $newStatus)
    {
        $index = $this->todoItems->search(function (Task $item) use ($taskID) {
            return $item->id === intval($taskID);
        });
        $item = $this->todoItems->pull($index);

        $list = &$this->{$nameItems};
        $list->push($item);

        $this->updateTaskStatus(intval($taskID), intval($newStatus));
    }

    public function updateListInProgress($taskID, $nameItems, $newStatus)
    {
        $index = $this->inProgressItems->search(function (Task $item) use ($taskID) {
            return $item->id === intval($taskID);
        });
        $item = $this->inProgressItems->pull($index);

        $list = &$this->{$nameItems};
        $list->push($item);

        $this->updateTaskStatus(intval($taskID), intval($newStatus));
    }

    public function updateListDone($taskID, $nameItems, $newStatus)
    {
        $index = $this->doneItems->search(function (Task $item) use ($taskID) {
            return $item->id === intval($taskID);
        });
        $item = $this->doneItems->pull($index);

        $list = &$this->{$nameItems};
        $list->push($item);

        $this->updateTaskStatus(intval($taskID), intval($newStatus));
    }

    public function openCreateTaskModal()
    {
        $this->emit('createTaskModalListeners');
    }

    public function openTaskModal($taskID)
    {
        $this->emit('updateTaskModalListeners', $taskID);
    }

    public function openCreateProjectBoardModal()
    {
        if (!$this->projectSelectedExpired) {
            $this->alertMessage('error', 'Project Board has not yet expired!');
            return;
        }
        $this->emit('createProjectBoardModalListeners');
    }

    public function openUpdateProjectBoardModal()
    {
        $this->emit('updateProjectBoardModalListeners', $this->projectBoard->id);
    }

    public function updateProjectBoard(ProjectBoard $projectBoard)
    {
        $this->projectBoard = $projectBoard;
        $this->alertMessage('success', 'Project board successfully updated!');
    }

    public function createTaskModal($taskID, $newNameItems)
    {
        $list = &$this->{$newNameItems};
        $item = Task::find($taskID);
        $list->push($item);

        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully created!');
    }

    public function updateTaskModal($taskID, $oldNameItems, $newNameItems)
    {
        $oldList = &$this->{$oldNameItems};
        $newList = &$this->{$newNameItems};

        $index = $oldList->search(function (Task $item) use ($taskID) {
            return $item->id === $taskID;
        });
        $item = $oldList->pull($index);

        $newList->push($item);

        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully updated!');
    }

    public function deleteTaskModal()
    {
        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully deleted!');
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
        $this->numberTodoItems = count($this->todoItems);
        $this->numberInProgressItems = count($this->inProgressItems);
        $this->numberDoneItems = count($this->doneItems);
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
        return view('livewire.project-board');
    }
}
