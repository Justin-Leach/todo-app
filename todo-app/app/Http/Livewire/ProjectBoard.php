<?php

namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\TaskStatus;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProjectBoard extends Component
{
    use LivewireAlert;

    public $todoItems;
    public $inProgressItems;
    public $doneItems;

    protected $listeners = [
        'updateListTodo' => 'updateListTodo',
        'updateListInProgress' => 'updateListInProgress',
        'updateListDone' => 'updateListDone',
        'createTaskModal' => 'createTaskModal',
        'updateTaskModal' => 'updateTaskModal',
        'deleteTaskModal' => 'deleteTaskModal' // the elements in the last get automatically remove
    ];

    public function mount()
    {
        $this->todoItems = Task::where('status_id', '=', TaskStatus::TASK_STATUS_TO_DO_ID)->get();
        $this->inProgressItems = Task::where('status_id', '=', TaskStatus::TASK_STATUS_IN_PROGRESS_ID)->get();
        $this->doneItems = Task::where('status_id', '=', TaskStatus::TASK_STATUS_DONE_ID)->get();
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

    public function createTaskModal($taskID, $newNameItems)
    {
        $list = &$this->{$newNameItems};
        $item = Task::find($taskID);
        $list->push($item);

        $this->alertMessage('Task successfully created!');
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

        $this->alertMessage('Task successfully updated!');
    }

    public function deleteTaskModal()
    {
        $this->alertMessage('Task successfully deleted!');
    }

    private function updateTaskStatus($taskID, $newStatus)
    {
        $task = Task::find($taskID);
        $task->status_id = $newStatus;
        $task->save();
    }

    private function alertMessage($message)
    {
        $this->alert('success', $message, [
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
