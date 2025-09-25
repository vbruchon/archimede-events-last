<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Structure;
use App\Models\NumberOfParticipants;
use App\Models\Tag;
use App\Models\AccessType;

class FilterBar extends Component
{


    public $structures;
    public $numberOfParticipants;
    public $selectedStructure;
    public $selectedParticipant;
    public $selectedDateStart;
    public $selectedDateEnd;
    public $accessTypes;
    public $selectedAccessType;
    public $tags;
    public $checkedTags;
    /*public $route; */

    public function mount()
    {
        $this->structures = Structure::get();
        $this->numberOfParticipants = NumberOfParticipants::get();
        $this->accessTypes = AccessType::get();
        $this->tags = Tag::get();
    }

    public function applyFilters()
    {
        // Récupérer les valeurs sélectionnées des filtres et les émettre via un événement Livewire
        $this->emit('filtersApplied', [
            'selectedStructure' => $this->selectedStructure,
            'selectedParticipant' => $this->selectedParticipant,
            'selectedDateStart' => $this->selectedDateStart,
            'selectedDateEnd' => $this->selectedDateEnd,
            'selectedAccessType' => $this->selectedAccessType,
            'selectedTags' => $this->checkedTags,
        ]);
    }
    public function render()
    {
        return view('livewire.filter-bar')
            ->with('structures', $this->structures)
            ->with('numberOfParticipants', $this->numberOfParticipants)
            ->with('selectedStructure', $this->selectedStructure)
            ->with('selectedParticipant', $this->selectedParticipant)
            ->with('selectedDateStart', $this->selectedDateStart)
            ->with('selectedDateEnd', $this->selectedDateEnd)
            ->with('accessTypes', $this->accessTypes)
            ->with('selectedAccessType', $this->selectedAccessType)
            ->with('tags', $this->tags)
            ->with('checkedTags', $this->checkedTags);
        /*->with('route', $this->route); */
    }
}
