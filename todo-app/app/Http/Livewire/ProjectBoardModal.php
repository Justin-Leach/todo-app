<?php

namespace App\Http\Livewire;

use App\Models\ProjectBoard;
use App\Models\Task;
use Livewire\Component;;

use Carbon\Carbon;

class ProjectBoardModal extends Component
{
    public ProjectBoard $projectBoard;

    public $dateSelected;

    // Modal
    public $createProjectBoardModal = false;
    public $updateProjectBoardModal = false;

    protected $listeners = [
        'createProjectBoardModalListeners' => 'createProjectBoardModal',
        'updateProjectBoardModalListeners' => 'updateProjectBoardModal',
        'dateSelected' => 'dateSelectedSS'
    ];

    protected $rules = [
        'projectBoard.name' => 'required|string|min:5',
        'dateSelected' => 'required|date',
    ];

    public function mount()
    {
        $this->dateSelected = Carbon::now()->format('Y-m-d');
    }

    public function createProjectBoardModal()
    {
        $this->projectBoard = new ProjectBoard();
        $this->createProjectBoardModal = true;
    }

    public function updateProjectBoardModal($projectBoardID)
    {
        $this->projectBoard = ProjectBoard::find($projectBoardID);
        $this->dateSelected = $this->projectBoard->expired_at->format('Y-m-d');
        $this->updateProjectBoardModal = true;

        $this->emit('updateProjectBoardEvent', $this->projectBoard->expired_at->format('Y-m-d H:i:s'));
    }

    public function createProjectBoard()
    {
        $this->validate();
        $this->projectBoard->owner_id = auth()->user()->id;
        $this->projectBoard->expired_at = $this->dateSelected;
        $this->projectBoard->save();
        $this->createProjectBoardModal = false;

        // Todo transfert all task that are undone to this tasks
        // Todo dispatch a event and
    }

    public function updateProjectBoard()
    {
        $this->validate();
        $this->projectBoard->expired_at = $this->dateSelected;
        $this->projectBoard->save();
        $this->updateProjectBoardModal = false;

        // Dispatch a event
        $this->emit('updateProjectBoardModal', $this->projectBoard);
    }

    public function dateSelectedSS($date)
    {
        $this->dateSelected = $date;
    }

    public function render()
    {
        return view('livewire.project-board-modal');
    }
}
