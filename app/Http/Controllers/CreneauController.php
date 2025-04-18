<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creneau;
use App\Notifications\CreneauModifie;


class CreneauController extends Controller
{
    public function index()
    {
        $creneaux = \App\Models\Creneau::with('users')->get();
        return view('creneaux.index', compact('creneaux'));
    }



    public function create()
    {
        $users = \App\Models\User::all(); // récupère tous les employés
        return view('creneaux.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $creneau = Creneau::create([
            'nom' => $validated['nom'],
            'heure_debut' => $validated['heure_debut'],
            'heure_fin' => $validated['heure_fin'],
        ]);

        // Mise à jour des utilisateurs affectés
        if (!empty($validated['users'])) {
            \App\Models\User::whereIn('id', $validated['users'])->update(['creneau_id' => $creneau->id]);
        }

        return redirect()->route('creneaux.index')->with('success', 'Créneau ajouté avec les employés.');
    }

    public function edit($id)
    {
        $creneau = Creneau::findOrFail($id);
        $users = \App\Models\User::where('role', 'employe')->get(); // uniquement les employés
        return view('creneaux.edit', compact('creneau', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'heure_debut' => 'required',
            'heure_fin' => 'required|after:heure_debut',
        ]);

        $creneau = Creneau::findOrFail($id);
        $creneau->update($request->only(['nom', 'heure_debut', 'heure_fin']));

        // ⚠️ Synchroniser les utilisateurs
        $creneau->users()->sync($request->input('users', []));

        // Notifier les utilisateurs affectés
        foreach ($creneau->users as $user) {
            $user->notify(new \App\Notifications\CreneauModifie($creneau));
        }

        return redirect()->route('creneaux.index')->with('success', 'Créneau mis à jour avec succès');
    }


    public function destroy(string $id)
    {
        $creneau = Creneau::findOrFail($id);
        $creneau->delete();

        return redirect()->route('creneaux.index')->with('success', 'Créneau supprimé avec succès');
    }

}
