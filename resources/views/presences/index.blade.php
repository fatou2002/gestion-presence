@extends('layouts.app')

@section('content')
    <h1>Liste des présences</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Bouton d’ajout --}}
    <a href="{{ route('presences.create') }}" class="btn btn-success mb-3"> ➕ Ajouter une présence</a>

    {{-- Menu de filtre --}}
    <form method="GET" action="{{ route('presences.index') }}" class="mb-4">
        <label for="filtre">📌 Filtrer :</label>
        <select name="filtre" id="filtre" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
            <option value="">-- Tous --</option>
            <option value="emargees" {{ request('filtre') === 'emargees' ? 'selected' : '' }}>✔️ Émargées</option>
            <option value="non_emargees" {{ request('filtre') === 'non_emargees' ? 'selected' : '' }}>❌ Non émargées</option>
        </select>
    </form>

    {{-- Tableau --}}
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Heure d'arrivée</th>
            <th>Heure de départ</th>
            <th>Émargement</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($presences as $presence)
            <tr>
                <td>{{ $presence->user->name }}</td>
                <td>{{ $presence->date }}</td>
                <td>{{ $presence->heure_arrivee ?? '—' }}</td>
                <td>{{ $presence->heure_depart ?? '—' }}</td>
                <td>
                    @if($presence->emargement)
                        ✅ Émargée
                    @else
                        ❌ Non émargée
                    @endif
                </td>
                <td>
                    {{-- Modifier --}}
                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-sm btn-primary">Modifier</a>

                    {{-- Supprimer --}}
                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette présence ?')">Supprimer</button>
                    </form>

                    {{-- Émarger (si non émargée) --}}
                    @if(!$presence->emargement)
                        <form method="POST" action="{{ route('presences.emarger', $presence->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Émarger</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
