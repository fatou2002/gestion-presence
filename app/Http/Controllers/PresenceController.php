<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Presence;
use Illuminate\Support\Facades\DB;
use App\Notifications\PresenceEnregistree;
use App\Mail\PresenceMailable;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresenceController extends Controller
{
    public function checkInForm()
    {
        return view('presences.checkin');
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'heure_arrivee' => 'required|date_format:H:i',
        ]);

        $user = Auth::user();

        $existingPresence = Presence::where('user_id', $user->id)
            ->where('date', $request->date)
            ->first();

        if ($existingPresence) {
            return redirect()->route('presences.checkin')->with('error', 'Vous avez déjà pointé aujourd’hui.');
        }

        $presence = Presence::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'heure_arrivee' => $request->heure_arrivee,
        ]);

        return redirect()->route('presences.index')->with('success', 'Check-in effectué avec succès.');
    }


    public function index(Request $request)
    {
        $query = Presence::with('user');

        if ($request->filtre === 'emargees') {
            $query->where('emargement', true);
        } elseif ($request->filtre === 'non_emargees') {
            $query->where('emargement', false);
        }

        $presences = $query->get();

        return view('presences.index', compact('presences'));
    }


    public function create()
    {
        $users = User::all();
        return view('presences.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'heure_arrivee' => 'nullable|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
        ]);

        Presence::create($request->all());

        return redirect()->route('presences.index')->with('success', 'Présence enregistrée.');
    }

    public function edit($id)
    {
        $presence = Presence::findOrFail($id);
        $users = User::all();
        return view('presences.edit', compact('presence', 'users'));
    }

    public function update(Request $request, $id)
    {
        $presence = Presence::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'heure_arrivee' => 'nullable|date_format:H:i',
            'heure_depart' => 'nullable|date_format:H:i',
        ]);

        $presence->update($request->all());

        return redirect()->route('presences.index')->with('success', 'Présence mise à jour.');
    }

    public function destroy($id)
    {
        $presence = Presence::findOrFail($id);
        $presence->delete();

        return redirect()->route('presences.index')->with('success', 'Présence supprimée.');
    }



    public function statistiques(Request $request)
    {
        $periode = $request->query('periode');

        // Appliquer le filtre sur la période
        $presencesQuery = Presence::query();

        if ($periode === 'mois') {
            $presencesQuery->whereMonth('date', now()->month);
        } elseif ($periode === 'semaine') {
            $presencesQuery->whereBetween('date', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        }

        // ✅ Correction ici : jointure avec users
        $presencesParEmploye = (clone $presencesQuery)
            ->join('users', 'presences.user_id', '=', 'users.id')
            ->select('users.name as name', DB::raw('count(*) as total'))
            ->groupBy('users.name')
            ->get();

        $labels = $presencesParEmploye->pluck('name');
        $data = $presencesParEmploye->pluck('total');

        // ✅ Évolution des présences
        $evolution = (clone $presencesQuery)
            ->select(DB::raw('DATE(date) as jour'), DB::raw('count(*) as total'))
            ->groupBy('jour')
            ->orderBy('jour')
            ->get();

        $dates = $evolution->pluck('jour');
        $evolutionData = $evolution->pluck('total');

        // ✅ Vérifie que Service::users() existe dans ton modèle Service
        $servicePresences = Service::withCount(['users as total_presences' => function ($query) use ($periode) {
            $query->join('presences', 'users.id', '=', 'presences.user_id');

            if ($periode === 'mois') {
                $query->whereMonth('presences.date', now()->month);
            } elseif ($periode === 'semaine') {
                $query->whereBetween('presences.date', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            }
        }])->get();

        $services = $servicePresences->pluck('nom');
        $presenceParService = $servicePresences->pluck('total_presences');

        return view('statistiques.index', compact(
            'labels', 'data', 'dates', 'evolutionData',
            'services', 'presenceParService'
        ));
    }

    public function emarger($id)
    {
        $presence = Presence::findOrFail($id);
        $presence->emargement = true;
        $presence->save();

        return redirect()->back()->with('success', 'Présence émargée avec succès.');
    }
    public function recap(Request $request)
    {
        $query = Presence::with('user');

        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filtre === 'emargees') {
            $query->where('emargement', true);
        } elseif ($request->filtre === 'non_emargees') {
            $query->where('emargement', false);
        }

        $presences = $query->get();
        $users = \App\Models\User::all();

        return view('presences.recap', compact('presences', 'users'));
    }


}
