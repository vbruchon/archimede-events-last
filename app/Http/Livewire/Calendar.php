<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Services\CreateSVGArray;

class Calendar extends Component
{
    public $events;
    public $svg;



    public function mount()
    {
        $allEvents = Event::all();
        $formattedEvents = [];

        foreach ($allEvents as $event) {
            $formattedEvents[] = [
                'title' => $event->name,
                'tags' => $event->tags,
                'structure' => $event->structure?->name,
                'partners' => $event->partners,
                'description' => $event->description,
                'nbre_participants' => $event->number_of_participants->name,
                'accessType' => $event->accessType->name,
                'start' => $event->date_start,
                'end' => $event->date_end,
                'hours' => $event->hours,
                'location' => $event->location,
                'link' => $event->link,
                'organizer_needs' => $event->organizer_needs,
                'author' => $event->user?->name,
                'is_Fix' => $event->is_Fix,
            ];
        }

        $this->events = json_encode($formattedEvents);

        $svgArray = new CreateSVGArray();
        $this->svg = $svgArray->createSvgArray();
    }


    public function render()
    {
        return view('livewire.calendar');
    }
}
