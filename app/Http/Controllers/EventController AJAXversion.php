<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Status;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('date_start')->where('date_end', '>', now())->get();
        $dateStartToString = [];
        $dateStartToDays = [];
        $dateEndToDays = [];
        foreach ($events as $event) {
            $key = $event->id;
            $convertDateStartToString = $this->convertDateToString($event->date_start);
            $dateStartToString[$key] = $convertDateStartToString;
            $convertDateStartToDays = $this->convertDateToDays($event->date_start);
            $dateStartToDays[$key] = $convertDateStartToDays;
            if (isset($event->date_end)) {
                $convertDateEndToDays = $this->convertDateToDays($event->date_end);
                $dateEndToDays[$key] = $convertDateEndToDays;
            }
        }
        $isAdmin = $this->checkUserAdmin();
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $svgIcons = $this->createSvgArray();

        return view('event.list', [
            'events' => $events,
            'dateStartToString' => $dateStartToString,
            'dateStartToDays' => $dateStartToDays,
            'dateEndToDays' => $dateEndToDays,
            'isAdmin' => $isAdmin,
            'structures' => $structures,
            'status' => $status,
            'numberOfParticipants' => $numberOfParticipants,
            'svg' => $svgIcons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();
        return view('event.createForm', ['structures' => $structures, 'status' => $status, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user]);
    }

    /**
     * Validate and add data in db
     */
    public function addEvent(Event $event, Request $request) {}
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $rules = [
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['required', 'string'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'number_of_participants_id' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'date_start' => ['required', 'date_format:d-m-Y H:i'],
            'date_end' => ['nullable', 'date_format:d-m-Y H:i', 'after_or_equal:date_start'],
            'hours' => ['required', 'string'],
            'organizer_needs' => ['nullable']
        ];

        $validated = $request->validate($rules, [
            'structure_id.required' => 'Le champ structure doit être défini.',
            'status_id.required' => 'Le champ status doit être défini.',
            'partners.required' => 'Le champ partenaires est obligatoire.',
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            'number_of_participants_id.required' => 'Le champ Nombre de participants est obligatoire.',
            'date_start.required' => 'Le champ Date de début est obligatoire.',
            'date_start.date_format' => 'Le champ Date de début doit être au format : d-m-Y H:i.',
            'date_end.date_format' => 'Le champ Date de fin doit être au format : d-m-Y H:i.',
            'hours.required' => 'Le champ Heure de début est obligatoire.',
        ]);


        $event = new Event();

        // Format date_start
        $inputDateStart = $validated['date_start'];
        $dateTimeStart = \DateTime::createFromFormat('d-m-Y H:i', $inputDateStart);
        $event->date_start = $dateTimeStart->format('Y-m-d H:i:s');

        // Format date_end if provided
        if (isset($validated['date_end'])) {
            $inputDateEnd = $validated['date_end'];
            $dateTimeEnd = \DateTime::createFromFormat('d-m-Y H:i', $inputDateEnd);
            $event->date_end = $dateTimeEnd->format('Y-m-d H:i:s');
        } else {
            $event->date_end = $event->date_start; // Set date_end as date_start if not provided
        }

        // Assign other validated fields to the event
        foreach ($validated as $field => $value) {
            if (!in_array($field, ['date_start', 'date_end'])) {
                $event->{$field} = $value;
            }
        }

        $event->is_Fix = $request->input('is_Fix');
        $event->user_id = Auth::user()->id;

        $event->save();

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // This method is empty in the provided code.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Structure $structures)
    {
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();

        return view('event.editForm', [
            'event' => $event,
            'structures' => $structures,
            'status' => $status,
            'numberOfParticipants' => $numberOfParticipants,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $rules = [
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['required', 'string'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'number_of_participants_id' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'date_start' => ['required', 'date_format:d-m-Y H:i'],
            'date_end' => ['nullable', 'date_format:d-m-Y H:i', 'after_or_equal:date_start'],
            'hours' => ['required', 'string'],
            'organizer_needs' => ['nullable']
        ];

        try {
            $validated = $request->validate($rules, [
                'structure_id.required' => 'Le champ structure doit être défini.',
                'status_id.required' => 'Le champ status doit être défini.',
                'partners.required' => 'Le champ partenaires est obligatoire.',
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
                'number_of_participants_id.required' => 'Le champ Nombre de participants est obligatoire.',
                'date_start.required' => 'Le champ Date de début est obligatoire.',
                'date_start.date_format' => 'Le champ Date de début doit être au format : d-m-Y H:i.',
                'date_end.date_format' => 'Le champ Date de fin doit être au format : d-m-Y H:i.',
                'hours.required' => 'Le champ Heure de début est obligatoire.',
            ]);

            foreach ($validated as $field => $value) {
                $event->{$field} = $value;
            }

            $event->save();

            return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été modifié.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('userEvent.all')->with('message', 'L\'événement a bien été supprimé.');
    }

    public function userContribution()
    {
        $user = Auth::user();
        $events = Event::where('user_id', $user->id)->get();

        return view('event.mycontribution', ['events' => $events]);
    }

    public function filteredEvents(Request $request)
    {
        $isAdmin = $this->checkUserAdmin();
        $selectedStructure = $request->input('structure');
        $selectedStatus = $request->input('status');
        $selectedParticipant = $request->input('number_of_participants');
        $structures = Structure::get();
        $status = Status::get();
        $numberOfParticipants = NumberOfParticipants::get();

        $query = $this->applyFilters($request);

        $events = $query->orderBy('date_start')->where('date_end', '>', now())->get();


        if (sizeof($events) < 1) {
            return view('event.list', [
                'events' => $events,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'status' => $status,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
                'selectedStatus' => $selectedStatus,
                'selectedParticipant' => $selectedParticipant,
            ]);
        } else {
            foreach ($events as $event) {
                $key = $event->id;

                $convertDateStartToString = $this->convertDateToString($event->date_start);
                $dateStartToString[$key] = $convertDateStartToString;

                $convertDateStartToDays = $this->convertDateToDays($event->date_start);
                $dateStartToDays[$key] = $convertDateStartToDays;

                if (isset($event->date_end)) {
                    $convertDateEndToDays = $this->convertDateToDays($event->date_end);
                    $dateEndToDays[$key] = $convertDateEndToDays;
                }
            }
            $svgIcons = $this->createSvgArray();


            // Sinon, retourne la vue partielle des événements filtrés
            return view('event.list', [
                'events' => $events,
                'dateStartToString' => $dateStartToString,
                'dateStartToDays' => $dateStartToDays,
                'dateEndToDays' => $dateEndToDays,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'status' => $status,
                'numberOfParticipants' => $numberOfParticipants,
                'selectedStructure' => $selectedStructure,
                'selectedStatus' => $selectedStatus,
                'selectedParticipant' => $selectedParticipant,
                'svg' => $svgIcons
            ]);
        }
    }

    private function applyFilters(Request $request)
    {
        $query = Event::query();
        if ($request->filled('structure')) {
            $structureName = $request->input('structure');
            $structure = Structure::where('name', $structureName)->first();
            if ($structure) {
                $query->where('structure_id', $structure->id);
            }
        }
        if ($request->filled('status')) {
            $statusName = $request->input('status');
            $status = Status::where('name', $statusName)->first();
            if ($status) {
                $query->where('status_id', $status->id);
            }
        }
        if ($request->filled('number_of_participants')) {
            $numberLabel = $request->input('number_of_participants');
            $participants = NumberOfParticipants::where('name', $numberLabel)->first();
            if ($participants) {
                $query->where('number_of_participants_id', $participants->id);
            }
        }
        return $query;
    }

    private function checkUserAdmin()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin;
        }
        return false;
    }

    private function convertDateToString($date)
    {
        return Carbon::parse($date)->format('d-m-Y H:i');
    }

    private function convertDateToDays($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    function createSvgArray()
    {
        // Replace the path with the actual path to your SVG file
        $structureSvgPath = public_path('image/structure-purple.svg');
        $partnerSvgPath = public_path('image/partners-purple.svg');
        $descriptionSvgPath = public_path('image/description.svg');
        $statuSvgPath = public_path('image/status-purple.svg');
        $participantsSvgPath = public_path('image/groups-purple.svg');
        $dateSvgPath = public_path('image/date-purple.svg');
        $needSvgPath = public_path('image/needs.svg');
        // Read the SVG file contents
        $structureSvgContents = file_get_contents($structureSvgPath);
        $structureSvg = str_replace('<svg', '<svg class="w-9 h-9"', $structureSvgContents);
        $partnerSvgContents = file_get_contents($partnerSvgPath);
        $partnerSvg = str_replace('<svg', '<svg class="w-9 h-9"', $partnerSvgContents);
        $descriptionSvgContent = file_get_contents($descriptionSvgPath);
        $descriptionSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $descriptionSvgContent);
        $statuSvgContent = file_get_contents($statuSvgPath);
        $statuSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $statuSvgContent);
        $particpantSvgContent = file_get_contents($participantsSvgPath);
        $particpantSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $particpantSvgContent);
        $dateSvgContent = file_get_contents($dateSvgPath);
        $dateSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $dateSvgContent);
        $needSvgContent = file_get_contents($needSvgPath);
        $needSvg = str_replace('<svg', '<svg class="w-9 h-9 mr-2"', $needSvgContent);
        return [
            'structure' => $structureSvg,
            'partners' => $partnerSvg,
            'description' => $descriptionSvg,
            'status' => $statuSvg,
            'participants' => $particpantSvg,
            'date' => $dateSvg,
            'needs' => $needSvg
        ];
    }
}
