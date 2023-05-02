<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;

class TaskModal extends Component
{
    public Task $task;

    // Dropdown
    public $isOpen = false;
    public $options = null;
    public $selectedOptionID = null;
    public $selectedOptionValue = null;

    // Modal
    public $createTaskModal = false;
    public $updateTaskModal = false;
    public $deleteTaskModal = false;

    protected $listeners = [
        'createTaskModalListeners' => 'createTaskModal',
        'updateTaskModalListeners' => 'updateTaskModal'
    ];

    protected $rules = [
        'task.title' => 'required|string|min:5',
        'task.description' => 'required|string|max:500',
        'task.priority' => 'required|integer|between:0,3',
        'task.importance' => 'required|integer|between:0,3',
    ];

    public function mount()
    {
        // Dropdown
        $this->options = TaskStatus::where('id', '!=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();
        $this->defaultDropdownStatus();
    }

    public function createTaskModal()
    {
        $this->task = new Task();
        $this->defaultDropdownStatus();
        $this->createTaskModal = true;
    }

    public function updateTaskModal($taskID)
    {
        $this->task = Task::find($taskID);
        $this->selectedOptionID = $this->task->status_id;
        $this->selectedOptionValue = $this->task->statusName($this->task->status_id);

        $this->deleteTaskModal = false;
        $this->updateTaskModal = true;
    }

    public function createTask()
    {
        $this->validate();
        $this->task->status_id = intval($this->selectedOptionID);
        $this->task->user_id = auth()->user()->id;
        $this->task->project_board_id = 1; // TODO change this to the selected project

        // TODO To Improve
        $latestTask = Task::where('tasks.project_board_id', '=', $this->task->project_board_id)
            ->where('tasks.status_id', '=', $this->task->status_id)
            ->orderBy('order', 'DESC')
            ->latest()
            ->first();

        $this->task->order = $latestTask ? $latestTask->order + 1 : 0;
        $this->task->save();

        $this->createTaskModal = false;
        $this->emit('createTaskModal', $this->task->id, $this->task->statusNameItem($this->task->status_id));
    }

    public function updateTask()
    {
        $previousStatus = $this->task->status_id;
        $previousOrder = $this->task->order;

        $this->validate();
        $this->task->status_id = intval($this->selectedOptionID);

        // TODO To Improve
        $latestTask = Task::where('tasks.project_board_id', '=', $this->task->project_board_id)
            ->where('tasks.status_id', '=', $this->task->status_id)
            ->orderBy('order', 'DESC')
            ->latest()
            ->first();

        $this->task->order = $latestTask ? $latestTask->order + 1 : 0;
        $this->task->save();

        // Need to update the previous list
        $tasks = Task::where('project_board_id', '=', $this->task->project_board_id)
            ->where('status_id', '=', $previousStatus)
            ->where('order', '>', $previousOrder)
            ->get();

        foreach ($tasks as $t) {
            $t->order = $t->order - 1;
            $t->save();
        }

        $this->updateTaskModal = false;
        $this->emit('updateTaskModal');
    }

    public function deleteTask()
    {
        $tasks = Task::where('project_board_id', '=', $this->task->project_board_id)
            ->where('status_id', '=', $this->task->status_id)
            ->where('order', '>', $this->task->order)
            ->get();

        $this->task->delete();

        foreach ($tasks as $t) {
            $t->order = $t->order - 1;
            $t->save();
        }

        $this->deleteTaskModal = false;
        $this->updateTaskModal = false;
        $this->emit('deleteTaskModal');
    }

    public function deleteTaskModal()
    {
        $this->deleteTaskModal = true;
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function selectOption($optionID, $optionValue)
    {
        $this->selectedOptionID = $optionID;
        $this->selectedOptionValue = $optionValue;
        $this->toggleDropdown();
    }

    private function defaultDropdownStatus()
    {
        $this->selectedOptionID = $this->options->first()->id;
        $this->selectedOptionValue = $this->options->first()->name;
    }

    public function render()
    {
        return view('livewire.task-modal');
    }
}
