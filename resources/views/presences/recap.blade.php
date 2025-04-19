@extends('layouts.app')

@section('content')
    <h1>📋 Récapitulatif des présences</h1>

    <form method="GET" action="{{ route('presences.recap') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="date">📅 Date</label>
            <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="user_id">👤 Employé</label>
            <select name="user_id" id="user_id" class="form-select">
                <option value="">-- Tous --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="filtre">📌 Émargement</label>
            <select name="filtre" id="filtre" class="form-select">
                <option value="">-- Tous --</option>
                <option value="emargees" {{ request('filtre') === 'emargees' ? 'selected' : '' }}>✔️ Émargées</option>
                <option value="non_emargees" {{ request('filtre') === 'non_emargees' ? 'selected' : '' }}>❌ Non émargées</option>
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">🔍 Rechercher</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Heure d'arrivée</th>
            <th>Heure de départ</th>
            <th>Émargement</th>
        </tr>
        </thead>
        <tbody>
        @forelse($presences as $presence)
            <tr>
                <td>{{ $presence->user->name }}</td>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->heure_arrivee ?? '—' }}</td>
                <td>{{ $presence->heure_depart ?? '—' }}</td>
                <td>
                    @if($presence->emargement)
                        ✅
                    @else
                        ❌
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Aucune présence trouvée.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
