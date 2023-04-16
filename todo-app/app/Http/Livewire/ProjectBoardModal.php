<?php

namespace App\Http\Livewire;

use App\Models\ProjectBoard;
use App\Models\Task;
use Livewire\Component;;

use Carbon\Carbon;

class ProjectBoardModal extends Component
{
    public ProjectBoard $projectBoard;

    // Modal
    public $createProjectBoardModal = false;
    public $updateProjectBoardModal = false;

    protected $listeners = [
        'createProjectBoardModalListeners' => 'createProjectBoardModal',
        'updateProjectBoardModalListeners' => 'updateProjectBoardModal',
        'dateSelectedListeners' => 'dateSelected'
    ];

    protected $rules = [
        'projectBoard.name' => 'required|string|min:5',
        'projectBoard.expired_at' => 'required|date',
    ];

    public function mount()
    {
    }

    public function createProjectBoardModal()
    {
        $this->projectBoard = new ProjectBoard();
        $this->createProjectBoardModal = true;
    }

    public function updateProjectBoardModal($projectBoardID)
    {
        $this->projectBoard = ProjectBoard::find($projectBoardID);
        $this->updateProjectBoardModal = true;
    }

    public function dateSelected($dateSelected)
    {
        $this->projectBoard->expired_at = $dateSelected;
    }

    public function createProjectBoard()
    {
        $this->validate();
        $this->projectBoard->owner_id = auth()->user()->id;
        $this->projectBoard->save();
        $this->createProjectBoardModal = false;

        // Todo transfert all task that are undone to this tasks
        // Todo dispatch a event and
    }

    public function updateProjectBoard()
    {
    }

    public function render()
    {
        return view('livewire.project-board-modal');
    }
}
