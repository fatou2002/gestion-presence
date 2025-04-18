@extends('layouts.app')

@section('content')
    <h1>Check-in</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('presences.checkin.store') }}" method="POST">
        @csrf

        <label for="date">Date :</label>
        <input type="date" name="date" value="{{ now()->toDateString() }}" required><br><br>

        <label for="heure_arrivee">Heure d'arrivée :</label>
        <input type="time" name="heure_arrivee" value="{{ now()->toTimeString() }}" required><br><br>

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('presences.index') }}">← Retour à la liste</a>
@endsection
