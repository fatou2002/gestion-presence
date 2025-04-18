@extends('layouts.app')

@section('content')
    <h1>Ajouter un créneau</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('creneaux.store') }}" method="POST">
        @csrf
        <label for="nom">Nom du créneau :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="heure_debut">Heure de début :</label>
        <input type="time" name="heure_debut" id="heure_debut" required><br>

        <label for="heure_fin">Heure de fin :</label>
        <input type="time" name="heure_fin" id="heure_fin" required><br>

        <label for="users">Affecter des employés :</label><br>
        <select name="users[]" id="users" multiple class="form-select" style="width: 300px;" size="6">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select><br><br>

        <button type="submit">Ajouter</button>
    </form>
@endsection
