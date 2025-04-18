@extends('layouts.app')

@section('content')
    <h1>Liste des présences</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('presences.create') }}" class="btn btn-success mb-3"> ➕Ajouter une présence</a>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Employe</th>
            <th>Date</th>
            <th>Heure d'arrivée</th>
            <th>Heure de départ</th>
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
                    <a href="{{ route('presences.edit', $presence->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('presences.destroy', $presence->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet presence ?')">Supprimer</button>
                    </form>
                    <form action="{{ route('presences.checkin.store') }}" method="POST">
                        @csrf
                        <!-- champs -->
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
