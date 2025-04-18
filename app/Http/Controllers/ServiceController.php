<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Affiche tous les services.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Formulaire de création d’un service.
     */
    public function create()
    {
        return view('services.create');
    }
    // ServiceController.php

    public function edit($id)
    {
        // Trouver le service par son ID
        $service = Service::findOrFail($id);

        // Retourner la vue d'édition avec le service
        return view('services.edit', compact('service'));
    }

    /**
     * Enregistre un nouveau service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Service::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('services.index')->with('success', 'Service ajouté');
    }
    // ServiceController.php

    // ServiceController.php

    public function show($id)
    {
        // Trouver le service par son ID
        $service = Service::findOrFail($id);

        // Retourner la vue pour afficher un seul service
        return view('services.show', compact('service'));
    }

    public function update(Request $request, $id)
    {
        // Valider la donnée du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Trouver le service par son ID
        $service = Service::findOrFail($id);

        // Mettre à jour le service
        $service->update([
            'nom' => $request->nom,
        ]);

        // Rediriger vers la liste des services avec un message de succès
        return redirect()->route('services.index')->with('success', 'Service mis à jour.');
    }

}
