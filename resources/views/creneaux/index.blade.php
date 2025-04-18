@extends('layouts.app')

@section('content')
    <div class="container">
        <h1><marquee>Liste des créneaux</marquee></h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('creneaux.create') }}" class="btn btn-success mb-3"> ➕Ajouter un créneau</a>

        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Employés affectés</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($creneaux as $creneau)
                <tr>
                    <td>{{ $creneau->nom }}</td>
                    <td>{{ $creneau->heure_debut }}</td>
                    <td>{{ $creneau->heure_fin }}</td>
                    <td>
                        @if($creneau->users->isEmpty())
                            <em>Aucun</em>
                        @else
                            <ul>
                                @foreach($creneau->users as $user)
                                    <li>{{ $user->name }} ({{ $user->email }})</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('creneaux.edit', $creneau->id) }}"class="btn btn-sm btn-primary">Modifier</a>

                        <form action="{{ route('creneaux.destroy', $creneau->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet creneaux ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
