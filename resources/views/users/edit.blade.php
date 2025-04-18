@extends('layouts.app')

@section('content')
    <h1>Modifier l'utilisateur</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nom :</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>

        <label for="role">Rôle :</label>
        <select name="role" required>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="manager" {{ $user->role === 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
            <option value="employe" {{ $user->role === 'employe' ? 'selected' : '' }}>Employé</option>
        </select><br>

        <label for="service_id">Service :</label>
        <select name="service_id" id="service_id">
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ $user->service_id == $service->id ? 'selected' : '' }}>
                    {{ $service->nom }}
                </option>
            @endforeach
        </select><br>

        <label for="creneau_id">Créneau :</label>
        <select name="creneau_id" id="creneau_id">
            @foreach($creneaux as $creneau)
                <option value="{{ $creneau->id }}" {{ $user->creneau_id == $creneau->id ? 'selected' : '' }}>
                    {{ $creneau->nom }} ({{ $creneau->heure_debut }} - {{ $creneau->heure_fin }})
                </option>
            @endforeach
        </select>

        <button class="btn btn-sm btn-warning">Mettre à jour</button>
    </form>
