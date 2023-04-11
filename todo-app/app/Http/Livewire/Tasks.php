<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskStatus;

class Tasks extends Component
{
    public Task $task;
    public bool $editMode = false;

    // Dropdown
    public $isOpen = false;
    public $options = null;
    public $selectedOptionID = null;
    public $selectedOptionValue = null;

    /**
     * Indicates if delete task is being confirmed.
     *
     * @var bool
     */
    public $confirmingDeleteTaskModal = false;


    public function mount($task, $updateTask)
    {
        $this->editMode = $updateTask;
        $this->task = $task;

        // Dropdown
        $this->options = TaskStatus::all();
        // Default value
        $this->selectedOptionID = $this->options->first()->id;
        $this->selectedOptionValue = $this->options->first()->name;
    }

    protected $rules = [
        'task.title' => 'required|string|min:5',
        'task.description' => 'required|string|max:500',
        'task.priority' => 'required|integer|between:0,3',
        'task.importance' => 'required|integer|between:0,3',
    ];

    /**
     * Create a Task, then redirect to the task table
     *
     */
    public function createTask()
    {
        // dd($this->selectedOptionID);

        $this->validate();
        $this->task->user_id = auth()->user()->id;
        $this->task->status_id = $this->selectedOptionID;
        $this->task->save();

        return redirect()->route('dashboard');
    }

    /**
     * Update a Task, then redirect to the task table
     *
     */
    public function updateTask()
    {
        $this->validate();
        $this->task->status_id = $this->selectedOptionID;
        $this->task->save();

        return redirect()->route('dashboard');
    }

    /**
     * Delete a Task, then redirect to the task table
     *
     */
    public function deleteTask()
    {
        $this->task->delete();
        return redirect()->route('dashboard');
    }

    /**
     * Confirm that the user would like to delete task.
     *
     * @return void
     */
    public function deleteTaskModal()
    {
        $this->confirmingDeleteTaskModal = true;
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
        return view('livewire.tasks');
    }
}
