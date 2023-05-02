<?php

namespace App\Http\Livewire;

use App\Models\ProjectBoard;
use App\Models\Task;
use App\Models\TaskOrder;
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
        'updateListOrder' => 'updateListOrder', // task order
        'updateProjectBoardModal' => 'updateProjectBoard', // Project board
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

    public function updateListTodo($taskID, $newStatus, $tableOrder)
    {
        $this->updateTaskStatus(intval($taskID), intval($newStatus));
        $this->updateListOrder($tableOrder);
        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully moved!');
    }

    public function updateListInProgress($taskID, $newStatus, $tableOrder)
    {
        $this->updateTaskStatus(intval($taskID), intval($newStatus));
        $this->updateListOrder($tableOrder);
        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully moved!');
    }

    public function updateListDone($taskID, $newStatus, $tableOrder)
    {
        $this->updateTaskStatus(intval($taskID), intval($newStatus));
        $this->updateListOrder($tableOrder);
        $this->updateCountTask();
        $this->alertMessage('success', 'Task successfully moved!');
    }

    public function updateListOrder($list)
    {
        foreach ($list as $key => $value) {
            $task = Task::find(intval(explode("-", $value)[1]));
            $task->order = $key;
            $task->save();
        }

        $this->refreshItemsList();
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

    public function updateTaskModal()
    {
        $this->refreshItemsList();
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

    private function refreshItemsList()
    {
        $this->todoItems = (new ProjectBoardRepository)->getProjectTaskTodo($this->projectBoard->id);
        $this->inProgressItems = (new ProjectBoardRepository)->getProjectTaskInProgress($this->projectBoard->id);
        $this->doneItems = (new ProjectBoardRepository)->getProjectTaskDone($this->projectBoard->id);
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
