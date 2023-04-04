<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\WithPagination;
use Livewire\Component;

class ShowTasks extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.show-tasks', [
            'tasks' => Task::paginate(2),
        ]);
    }
}
