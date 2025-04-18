@extends('layouts.app')

@section('content')
    <h1>Modifier une présence</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('presences.update', $presence->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="user_id">employe :</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $presence->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select><br><br>

        <label for="date">Date :</label>
        <input type="date" name="date" value="{{ $presence->date }}" required><br><br>

        <label for="heure_arrivee">Heure d'arrivée :</label>
        <input type="time" name="heure_arrivee" value="{{ $presence->heure_arrivee }}"><br><br>

        <label for="heure_depart">Heure de départ :</label>
        <input type="time" name="heure_depart" value="{{ $presence->heure_depart }}"><br><br>

        <button class="btn btn-sm btn-warning">Mettre à jour</button>
    </form>

    <a href="{{ route('presences.index') }}">← Retour à la liste</a>
@endsection
