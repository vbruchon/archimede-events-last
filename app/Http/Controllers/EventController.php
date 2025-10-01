<?php

namespace App\Http\Controllers;

use App\Models\AccessType;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NumberOfParticipants;
use App\Models\Structure;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Services\EventExportFileService;
use App\Services\CreateSVGArray;
use App\Services\DateConversionService;
use Carbon\Carbon;



class EventController extends Controller
{
    /**
     * Validate the event data.
     */
    private function validateEvent(Request $request)
    {
        return $request->validate([
            'structure_id' => ['required', 'integer', 'exists:structures,id'],
            'partners' => ['nullable', 'string'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'number_of_participants_id' => ['required', 'string'],
            'accessType_id' => ['required'],
            'link' => ['nullable', 'string'],
            'location' => ['nullable', 'string'],

            'date_start' => ['required', 'date_format:d-m-Y H:i'], // Validates the input format
            'date_end' => ['nullable', 'date_format:d-m-Y H:i', 'after_or_equal:date_start'],
            'organizer_needs' => ['nullable'],
        ], [
            'structure_id.required' => 'Le champ Structure est obligatoire',
            'name.required' => 'Le champ Nom est obligatoire.',
            'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            'number_of_participants_id.required' => 'Le champ Nombre de participants est obligatoire.',
            'date_start.required' => 'Le champ Date de début est obligatoire.',
            'date_start.date' => 'Le champ Date de début doit être une date valide.',
            'date_end.date' => 'Le champ Date de fin doit être une date valide.',
            'hours.required' => 'Le champ Heure de début est obligatoire.',
        ]);
    }
    /**
     * Fill the event fields with the validated data.
     */
    private function fillEventFields(Event $event, array $validated)
    {
        foreach ($validated as $field => $value) {
            if ($field === 'date_end' && $value === null) {
                $event->date_end = $event->date_start;
            } else if ($field === 'name' || $field === 'location' || $field === 'description') {
                $event->{$field} = str_replace("\"", "'", $value);
            } else {
                $event->{$field} = $value;
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(DateConversionService $dateConversion, CreateSVGArray $svg)
    {
        $today = Carbon::now();
        $events = Event::with('structure', 'number_of_participants', 'accessType')
            ->where('date_start', '>=', $today)
            ->has('structure')
            ->has('number_of_participants')
            ->has('accessType')
            ->has('tags')
            ->orderBy('date_start', 'asc')
            ->get();

        $dateStartToString = [];
        $dateStartToDays = [];
        $dateEndToDays = [];

        foreach ($events as $event) {
            $key = $event->id;

            $convertDateStartToString = $dateConversion->convertDateToString($event->date_start);
            $dateStartToString[$key] = $convertDateStartToString;

            $convertDateStartToDays = $dateConversion->convertDateToDays($event->date_start);
            $dateStartToDays[$key] = $convertDateStartToDays;

            if (isset($event->date_end)) {
                $convertDateEndToDays = $dateConversion->convertDateToDays($event->date_end);
                $dateEndToDays[$key] = $convertDateEndToDays;
            }
        }
        $isAdmin = (new UserController)->checkUserAdmin();

        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $accessTypes = AccessType::get();
        $tags = Tag::get();

        $svgIcons = $svg->createSvgArray();


        return view('event.list', [
            'events' => $events,
            'dateStartToString' => $dateStartToString,
            'dateStartToDays' => $dateStartToDays,
            'dateEndToDays' => $dateEndToDays,
            'isAdmin' => $isAdmin,
            'structures' => $structures,
            'numberOfParticipants' => $numberOfParticipants,
            'accessTypes' => $accessTypes,
            'tags' => $tags,
            'svg' => $svgIcons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();
        $accessType = AccessType::get();
        $tags = Tag::get();
        return view('event.createForm', ['structures' => $structures, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user, 'accessType' => $accessType, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tagIds = $request->input('tags');

        $validated = $this->validateEvent($request);

        $event = new Event();
        $this->fillEventFields($event, $validated);
        $event->is_Fix = $request->input('is_Fix');
        $event->user_id = Auth::user()->id;

        $event->save();

        $event->tags()->attach($tagIds);

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été créé');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Structure $structures)
    {
        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $user = Auth::user();
        $accessType = AccessType::get();
        $tags = Tag::get();

        return view('event.editForm', ['event' => $event, 'structures' => $structures, 'numberOfParticipants' => $numberOfParticipants, 'user' => $user, 'accessType' => $accessType, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $this->validateEvent($request);

        $this->fillEventFields($event, $validated);
        $event->is_Fix = $request->has('is_Fix');
        $event->save();

        return redirect()->route('userEvent.all')->with('success', 'L\'événement a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('userEvent.all')->with('success', "L'événement a bien été supprimé");
    }





    public function userContribution(CreateSVGArray $svg)
    {
        $user = Auth::user();
        $events = Event::where('user_id', '=', $user->id)->get();
        $svgIcons = $svg->createSvgArray();
        $isAdmin = (new UserController)->checkUserAdmin();

        return view('event.list', ['events' => $events, 'svg' => $svgIcons, 'isAdmin' => $isAdmin]);
    }

    public function filteredEvents(Request $request, DateConversionService $dateConversion, CreateSVGArray $svg)
    {
        $isAdmin = (new UserController)->checkUserAdmin();
        $selectedStructure = $request->input('structure');
        $selectedParticipant = $request->input('participants');
        $selectedAccessType = $request->input('accessType');
        $checkedTags = $request->input('tags') ?? [];
        $selectedDateStart = $request->input('date_start');
        $selectedDateEnd = $request->input('date_end');
        $structures = Structure::get();
        $numberOfParticipants = NumberOfParticipants::get();
        $accessTypes = AccessType::get();
        $tags = Tag::get();




        $query = $this->applyFilters($request);

        $events = $query->orderBy('date_start')->get();
        $dateStartToString = [];
        $dateStartToDays = [];
        $dateEndToDays = [];

        foreach ($events as $event) {
            $key = $event->id;

            $convertDateStartToString = $dateConversion->convertDateToString($event->date_start);
            $dateStartToString[$key] = $convertDateStartToString;

            $convertDateStartToDays = $dateConversion->convertDateToDays($event->date_start);
            $dateStartToDays[$key] = $convertDateStartToDays;

            if (isset($event->date_end)) {
                $convertDateEndToDays = $dateConversion->convertDateToDays($event->date_end);
                $dateEndToDays[$key] = $convertDateEndToDays;
            }
        }

        if (sizeof($events) < 1) {
            return view('event.list', [
                'events' => $events,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'numberOfParticipants' => $numberOfParticipants,
                'accessTypes' => $accessTypes,
                'tags' => $tags,
                'selectedStructure' => $selectedStructure,
                'selectedParticipant' => $selectedParticipant,
                'selectedAccessType' => $selectedAccessType,
                'checkedTags' => $checkedTags,
                'selectedDateStart' => $selectedDateStart,
                'selectedDateEnd' => $selectedDateEnd,

            ]);
        } else {
            foreach ($events as $event) {
                $key = $event->id;

                $convertDateStartToString = $dateConversion->convertDateToString($event->date_start);
                $dateStartToString[$key] = $convertDateStartToString;

                $convertDateStartToDays = $dateConversion->convertDateToDays($event->date_start);
                $dateStartToDays[$key] = $convertDateStartToDays;

                if (isset($event->date_end)) {
                    $convertDateEndToDays = $dateConversion->convertDateToDays($event->date_end);
                    $dateEndToDays[$key] = $convertDateEndToDays;
                }
            }

            $svgIcons = $svg->createSvgArray();

            return view('event.list', [
                'events' => $events,
                'dateStartToString' => $dateStartToString,
                'dateStartToDays' => $dateStartToDays,
                'dateEndToDays' => $dateEndToDays,
                'isAdmin' => $isAdmin,
                'structures' => $structures,
                'numberOfParticipants' => $numberOfParticipants,
                'accessTypes' => $accessTypes,
                'tags' => $tags,
                'selectedStructure' => $selectedStructure,
                'selectedParticipant' => $selectedParticipant,
                'selectedAccessType' => $selectedAccessType,
                'checkedTags' => $checkedTags,
                'selectedDateStart' => $selectedDateStart,
                'selectedDateEnd' => $selectedDateEnd,
                'svg' => $svgIcons
            ]);
        }
    }

    private function applyFilters(Request $request)
    {
        $query = Event::query();

        if ($request->filled('structure')) {
            $structureName = $request->input('structure');
            $query->whereHas('structure', fn($q) => $q->where('name', $structureName));
        }

        if ($request->filled('participants')) {
            $numberName = $request->input('participants');
            $query->whereHas('number_of_participants', fn($q) => $q->where('name', $numberName));
        }

        if ($request->filled('accessType')) {
            $accessTypeName = $request->input('accessType');
            $query->whereHas('accessType', fn($q) => $q->where('name', $accessTypeName));
        }

        if ($request->filled('tags')) {
            $tags = $request->input('tags');
            $query->whereHas('tags', fn($q) => $q->whereIn('id', $tags));
        }

        $dateStart = $request->input('date_start');
        $dateEnd = $request->input('date_end');

        if ($dateStart || $dateEnd) {
            $query->where(function ($q) use ($dateStart, $dateEnd) {
                if ($dateStart) {
                    $start = Carbon::createFromFormat('Y-m-d', $dateStart)->startOfDay();
                }
                if ($dateEnd) {
                    $end = Carbon::createFromFormat('Y-m-d', $dateEnd)->endOfDay();
                }

                if ($dateStart && !$dateEnd) {
                    $q->whereDate('date_start', $start->format('Y-m-d'));
                } elseif (!$dateStart && $dateEnd) {
                    $q->whereDate('date_end', $end->format('Y-m-d'));
                } elseif ($dateStart && $dateEnd) {
                    $q->whereBetween('date_start', [$start, $end])
                        ->orWhereBetween('date_end', [$start, $end]);
                }
            });
        }

        return $query;
    }


    public function export(EventExportFileService $exportFileService)
    {
        $events = Event::all();

        $icsData = $exportFileService->exportToICS($events);

        return response($icsData)
            ->header('Content-Type', 'text/calendar')
            ->header('Content-Disposition', 'attachment; filename="events.ics"');
    }
}
