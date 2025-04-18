<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Creneau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     */
    public function index()
    {
        $users = User::with('service')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un utilisateur.
     */
    public function create()
    {
        $services = Service::all();
        $creneaux = Creneau::all(); // Ajoute cette ligne
        return view('users.create', compact('services', 'creneaux'));
    }


    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:admin,manager,employe',
            'service_id' => 'required|exists:services,id',
            'creneau_id' => 'required|exists:creneaux,id',
        ]);

        // Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'service_id' => $request->service_id,
            'creneau_id' => $request->creneau_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur.
     */public function edit($id)
{
    $user = User::findOrFail($id);
    $services = Service::all();
    $creneaux = Creneau::all();
    return view('users.edit', compact('user', 'services', 'creneaux'));
}


    /**
     * Met à jour un utilisateur existant.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,gestionnaire,employe',
            'service_id' => 'required|exists:services,id',
            'creneau_id' => 'nullable|exists:creneaux,id',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
