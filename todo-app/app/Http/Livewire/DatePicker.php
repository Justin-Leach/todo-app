<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class DatePicker extends Component
{
    public $date;

    protected $listeners = [
        'datePickerSelectedModalListeners' => 'updatedDate'
    ];

    public function render()
    {
        return view('livewire.date-picker');
    }

    public function updatedDate($dateSelected)
    {
        $this->date = $dateSelected;
        $this->emit('dateSelectedListeners', $this->date);
    }
}
