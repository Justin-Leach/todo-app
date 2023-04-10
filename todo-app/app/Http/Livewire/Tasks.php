<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{
    public Task $task;
    public bool $editMode = false;

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
    }

    protected $rules = [
        'task.title' => 'required|string|min:5',
        'task.description' => 'required|string|max:500',
        'task.priority' => 'required|integer|between:0,3',
        'task.importance' => 'required|integer|between:0,3',
        'task.completed' => 'required|boolean'
    ];

    /**
     * Create a Task, then redirect to the task table
     *
     */
    public function createTask()
    {
        $this->validate();
        $this->task->user_id = auth()->user()->id;
        $this->task->save();

        return redirect()->route('tasks');
    }

    /**
     * Update a Task, then redirect to the task table
     *
     */
    public function updateTask()
    {
        $this->validate();
        $this->task->save();

        return redirect()->route('tasks');
    }

    /**
     * Delete a Task, then redirect to the task table
     *
     */
    public function deleteTask()
    {
        $this->task->delete();
        return redirect()->route('tasks');
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

    public function render()
    {
        return view('livewire.tasks');
    }
}
