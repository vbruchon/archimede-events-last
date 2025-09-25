<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventManagement extends Component
{
    public $activeView = 'event-list';

    public function showEventList()
    {
        $this->activeView = 'event-list';
        
    }

    public function showCalendar()
    {
        $this->activeView = 'calendar';
    }

    public function render()
    {
        return view('livewire.event-management');
    }
}
