<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessType;


class AccessTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessTypes = AccessType::get();
        return view('accessType.list', ['accessTypes' => $accessTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accessType.createForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccessType $accessType, Request $request)
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

        $accessType->name = $rules['name'];
        $accessType->save();

        return redirect()->route('admin.accessType.list')->with('success', 'Type d\'accès ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessType $accessType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccessType $accessType)
    {
        return view('accessType.editForm', ['accessType' => $accessType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessType $accessType)
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

        $accessType->name = $rules['name'];
        $accessType->save();

        return redirect()->route('admin.accessType.list')->with('success', 'Type d\'accès modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessType $accessType)
    {
        $accessType->delete();

        return redirect()->route('admin.accessType.list')->with('sucess', 'Le type d\'accès à bien était supprimée');
    }
}
