<?php

namespace App\Http\Controllers;

use App\Models\NumberOfParticipants;
use Illuminate\Http\Request;

class NumberOfParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numberOfParticipants = NumberOfParticipants::get();

        return view('numberOfParticipants.list', ['numberOfParticipants' => $numberOfParticipants]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('numberOfParticipants.createForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, NumberOfParticipants $numberOfParticipant)
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
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NumberOfParticipants $numberOfParticipant)
    {
        return view('numberOfParticipants.editForm', ['numberOfParticipant' => $numberOfParticipant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NumberOfParticipants $numberOfParticipant)
    {
        $this->store($request, $numberOfParticipant);

        return redirect()->route('admin.numberOfParticipants.list')->with('success', 'Le nombre de participants a été modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NumberOfParticipants $numberOfParticipant)
    {
        $numberOfParticipant->delete();
        
        return redirect()->route('admin.numberOfParticipants.list')->with('success', 'Le nombre de participants a été supprimé avec succès !');
    }
}
