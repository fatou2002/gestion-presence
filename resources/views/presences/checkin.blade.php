@extends('layouts.app')

@section('content')
    <h1>Faire le pointage (Check-in)</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('presences.checkin.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">Date :</label>
            <input type="date" name="date" value="{{ now()->toDateString() }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="heure_arrivee" class="form-label">Heure d'arrivée :</label>
            <input type="time" name="heure_arrivee" value="{{ now()->format('H:i') }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">📌 Enregistrer le pointage</button>
    </form>

    <a href="{{ route('presences.index') }}" class="btn btn-link mt-3">← Retour à la liste</a>
@endsection
