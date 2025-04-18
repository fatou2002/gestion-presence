@extends('layouts.app')

@section('content')
    <h1>Créer un utilisateur</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label for="name">Nom :</label>
        <input type="text" name="name" value="{{ old('name') }}" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required><br>

        <label for="password_confirmation">Confirmer mot de passe :</label>
        <input type="password" name="password_confirmation" required><br>

        <label for="role">Rôle :</label>
        <select name="role" required>
            <option value="">-- Choisir un rôle --</option>
            <option value="admin">Admin</option>
            <option value="manager">Gestionnaire</option>
            <option value="employe">Employé</option>
        </select><br>

        <label for="service_id">Service :</label>
        <select name="service_id" required>
            <option value="">-- Choisir un service --</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->nom }}</option>
            @endforeach
        </select><br>

        <label for="creneau_id">Créneau :</label>
        <select name="creneau_id" required>
            <option value="">-- Choisir un créneau --</option>
            @foreach($creneaux as $creneau)
                <option value="{{ $creneau->id }}">{{ $creneau->nom }} ({{ $creneau->heure_debut }} - {{ $creneau->heure_fin }})</option>
            @endforeach
        </select><br><br>


        <button type="submit">Créer</button>
    </form>
@endsection
