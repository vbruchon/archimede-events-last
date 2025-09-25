<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $isAdmin = (new UserController)->checkUserAdmin();

        //Je recupère tous es événements
        $events = Event::get();

        //Je compte le nbre d'events
        $countEvents = count($events);


        // Je récupère uniquement les événements qui ont lieu dans les 30 prochains jours
        $futureEvents = $this->getUpcommingEvents();

        $user = Auth::user();
        $userEvent = Event::where('user_id', '=', $user->id)->latest('id')->first();

        $countUsers = $this->countUser();

        $latestUser = $this->lastUserCreate();
        $lastEventsCreate = $this->displayTheLastEventsCreate();

        $svgIcons = $this->createSvgArrayDashboard();

        return view(
            'dashboard',
            [
                'isAdmin' => $isAdmin,
                'countEvents' => $countEvents,
                'futureEvents' => $futureEvents,
                'userEvent' => $userEvent,
                'countUsers' => $countUsers,
                'latestUser' => $latestUser,
                'lastEventsCreate' => $lastEventsCreate,
                'svg' => $svgIcons
            ]
        );
    }

    function getUpcommingEvents()
    {
        $now = Carbon::now();
        $end = $now->copy()->addDays(30);

        return Event::where('date_start', '>=', $now)
            ->where('date_start', '<=', $end)
            ->orderBy('date_start')
            ->get();
    }

    function countUser()
    {
        $this->middleware('admin');

        $users = User::get();

        return count($users);
    }

    function lastUserCreate()
    {
        $this->middleware('admin');

        $latestUser = User::latest('id')->first();

        return $latestUser;
    }

    function createSvgArrayDashboard()
    {
        // Replace the path with the actual path to your SVG file
        $eventSvgPath = public_path('image/event.svg');
        $userSvgPath = public_path('image/user.svg');

        // Read the SVG file contents

        $eventSvgContent = file_get_contents($eventSvgPath);
        $eventSvg = str_replace('<svg', '<svg class="w-9 h-9"', $eventSvgContent);
        $userSvgContent = file_get_contents($userSvgPath);
        $userSvg = str_replace('<svg', '<svg class="w-9 h-9"', $userSvgContent);

        return [
            'event' => $eventSvg,
            'user' => $userSvg
        ];
    }

    function displayTheLastEventsCreate()
    {
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $lastEventsCreate = Event::whereBetween('created_at', [$startDate, $endDate])->get();

        return $lastEventsCreate;
    }
}







/**
 * Display a listing of the resource.
 */
/* public function index()
    {
        $numberOfParticipants = NumberOfParticipants::get();

        return view('numberOfParticipants.list', ['numberOfParticipants' => $numberOfParticipants]);
    } */

/**
 * Show the form for creating a new resource.
 */
/* public function create()
    {
        return view('numberOfParticipants.createForm');
    } */

/**
 * Store a newly created resource in storage.
 */
/* public function store(Request $request, NumberOfParticipants $numberOfParticipant)
    {
        // Validation
        $rules = $request->validate(
            [
                'name' => 'required|max:150',
            ],
            [
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
            ]
        );

        $numberOfParticipant->name = $rules['name'];
        $numberOfParticipant->save();

        return redirect()->route('admin.numberOfParticipants.list')->with('success', 'Le nombre de participants à était ajouté avec succès.');
    } */


/**
 * Show the form for editing the specified resource.
 */
/*  public function edit(NumberOfParticipants $numberOfParticipant)
    {
        return view('numberOfParticipants.editForm', ['numberOfParticipant' => $numberOfParticipant]);
    } */

/**
 * Update the specified resource in storage.
 */
/* public function update(Request $request, NumberOfParticipants $numberOfParticipant)
    {
        $this->store($request, $numberOfParticipant);

        return redirect()->route('admin.numberOfParticipants.list')->with('success', 'Le nombre de participants a été modifié avec succès !');
    } */

/**
 * Remove the specified resource from storage.
 */
/*     public function destroy(NumberOfParticipants $numberOfParticipant)
    {
        $numberOfParticipant->delete();
        
        return redirect()->route('admin.numberOfParticipants.list')->with('success', 'Le nombre de participants a été supprimé avec succès !');
    } */