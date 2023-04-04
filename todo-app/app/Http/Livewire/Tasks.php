<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{
    public Task $task;

    public function mount()
    {
        $this->task = new Task();
    }

    protected $rules = [
        'task.title' => 'required|string|min:5',
        'task.description' => 'required|string|max:500',
        'task.priority' => 'required|integer|between:0,3',
        'task.importance' => 'required|integer|between:0,3',
    ];

    public function saveTask()
    {
        $this->validate();
        $this->task->user_id = auth()->user()->id;
        $this->task->save();
    }

    public function render()
    {
        return view('livewire.tasks');
    }
}
