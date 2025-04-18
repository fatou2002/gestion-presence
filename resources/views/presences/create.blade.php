@extends('layouts.app')

@section('content')
    <h1>Ajouter une présence</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('presences.store') }}" method="POST">
        @csrf

        <label for="user_id">Employe :</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select><br><br>

        <label for="date">Date :</label>
        <input type="date" name="date" required><br><br>

        <label for="heure_arrivee">Heure d'arrivée :</label>
        <input type="time" name="heure_arrivee"><br><br>

        <label for="heure_depart">Heure de départ :</label>
        <input type="time" name="heure_depart"><br><br>

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('presences.index') }}">← Retour à la liste</a>
@endsection
