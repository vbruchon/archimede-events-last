<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('admin.listUser', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.editFormUser', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        // Validation
        $rules = $request->validate(
            [
                'name' => 'required|max:150',
                'email' => 'required|unique:users,email,' . $user->id,
                'password' => ''
            ],
            [
                'name.required' => 'Le champ Nom est obligatoire.',
                'name.max' => 'Le champ Nom ne doit pas dépasser 150 caractères.',
                'email.required' => 'Les champ Email est obligatoire.',
                'email.unique' => 'Cet email est déjà associé à un compte en base de données.',
                //'password.required' => 'Le champ password est obligatoire'
            ]
        );

        $user->name = $rules['name'];
        $user->email = $rules['email'];
        $user->password = $rules['password'];

        return $user->update();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->store($user, $request);

        return redirect()->route('admin.users.list')->with('success', 'L\'utilisateur a été modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.list')->with('success', 'L\'utilisateur a été supprimé avec succès !');
    }

    function checkUserAdmin()
    {
        if (Auth::check()) {
            return Auth::user()->is_admin;
        }
        return false;
    }
}
