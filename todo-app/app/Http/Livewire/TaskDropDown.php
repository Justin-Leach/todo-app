<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;

class TaskDropDown extends Component
{
    public Task $task;

    // Dropdown
    public $isOpen = false;
    public $options = null;
    public $selectedOptionID = null;
    public $selectedOptionValue = null;

    public function mount($taskID)
    {
        $this->task = Task::find($taskID);

        // Dropdown
        //  TaskStatus::where('id', '!=', TaskStatus::TASK_STATUS_BACKLOG_ID)->get();
        $this->options = TaskStatus::all();
        $this->selectedOptionID = $this->options->where('id', '=', $this->task->status_id)->first()->id;
        $this->selectedOptionValue = $this->options->where('id', '=', $this->task->status_id)->first()->name;
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

    public function render()
    {
        return view('livewire.task-drop-down');
    }
}
