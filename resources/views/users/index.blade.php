@extends('layouts.app')

@section('content')
    <h1>Liste des utilisateurs</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">
        ➕ Ajouter un utilisateur
    </a>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Service</th>
            <th>Creneaux</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->service?->nom ?? 'Non assigné' }}</td>
                <td>{{ $user->creneau?->nom ?? 'Non assigné' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>


@endsection
