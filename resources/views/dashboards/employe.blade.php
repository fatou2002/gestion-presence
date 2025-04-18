@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tableau de bord Employé</h1>

        <div class="alert alert-info">
            Bienvenue, <strong>{{ auth()->user()->name }}</strong><br>
            Rôle : <span class="badge bg-success">Employé</span>
        </div>

        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('presences.checkin') }}" class="btn btn-primary mt-3">🕒 Pointer ma présence</a></li>
            <li class="list-group-item"><a href="{{ route('presences.index') }}">📋 Voir mes présences</a></li>
        </ul>
    </div>
@endsection
