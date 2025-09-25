<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Services\CreateSVGArray;
use App\Services\DateConversionService;
use App\Http\Controllers\UserController;

class EventList extends Component
{
    public $events;
    public $dateStartToString;
    public $dateStartToDays;
    public $dateEndToDays;
    public $isAdmin;
    public $structures;
    public $numberOfParticipants;
    public $accessTypes;
    public $tags;
    public $svg;

    public $filters = [];
    public $filteredEvents;

    protected $listeners = ['filtersApplied' => 'applyFilters'];

    public function mount(DateConversionService $dateConversion, CreateSVGArray $svgArray)
    {
        $this->loadEvents($dateConversion, $svgArray);
    }

    public function loadEvents(DateConversionService $dateConversion, CreateSVGArray $svgArray)
    {
        $today = now();

        $query = Event::with('structure', 'number_of_participants', 'accessType')
            ->has('structure')
            ->has('number_of_participants')
            ->has('accessType')
            ->has('tags')
            ->orderBy('date_start', 'asc');

        $eventsAll = $query->get();

        $this->dateStartToString = [];
        $this->dateStartToDays = [];
        $this->dateEndToDays = [];

        foreach ($eventsAll as $event) {
            $key = $event->id;

            $convertDateStartToString = $dateConversion->convertDateToString($event->date_start);
            $this->dateStartToString[$key] = $convertDateStartToString;

            $convertDateStartToDays = $dateConversion->convertDateToDays($event->date_start);
            $this->dateStartToDays[$key] = $convertDateStartToDays;

            if (isset($event->date_end)) {
                $convertDateEndToDays = $dateConversion->convertDateToDays($event->date_end);
                $this->dateEndToDays[$key] = $convertDateEndToDays;
            }
        }

        $this->events = $eventsAll;
        $this->isAdmin = (new UserController)->checkUserAdmin();

        $svgIcons = $svgArray->createSvgArray();
        $this->svg = $svgIcons;
    }

    public function applyFilters($selectedFilters)
    {
        // Réinitialiser la liste des événements
        $this->filters = $selectedFilters;
        $this->filterEvents();
    }

    public function filterEvents()
    {
        $today = now();
        $query = Event::with('structure', 'number_of_participants', 'accessType')
            ->has('structure')
            ->has('number_of_participants')
            ->has('accessType')
            ->has('tags')
            ->orderBy('date_start', 'asc');

        if (isset($this->filters['selectedStructure'])) {
            $query->where('structure_id', $this->filters['selectedStructure']);
        }

        if (isset($this->filters['selectedDateStart']) && isset($this->filters['selectedDateEnd'])) {
            $query->where('date_start', '>=', $this->filters['selectedDateStart'])
                ->where('date_end', '<=', $this->filters['selectedDateEnd']);
        } elseif (isset($this->filters['selectedDateStart'])) {
            $query->where('date_start', '=', $this->filters['selectedDateStart']);
        } elseif (isset($this->filters['selectedDateEnd'])) {
            $query->where('date_end', '=', $this->filters['selectedDateEnd']);
        } else {
            $query->where('date_start', '>=', $today);
        }

        $query->orderBy('date_start', 'asc');
        $this->filteredEvents = $query->get();

        $this->events = $this->filteredEvents;
    }

    public function render()
    {
        return view('livewire.event-list');
    }
}
