@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tableau de bord Administrateur</h1>

        <div class="alert alert-info">
            Bienvenue, <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})<br>
            Rôle : <span class="badge bg-primary">Administrateur</span>
        </div>

        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('users.index') }}">👥 Gérer les utilisateurs</a></li>
            <li class="list-group-item"><a href="{{ route('services.index') }}">🏢 Gérer les services</a></li>
            <li class="list-group-item"><a href="{{ route('creneaux.index') }}">📅 Gérer les créneaux</a></li>
            <li class="list-group-item"><a href="{{ route('presences.index') }}">📋 Voir les présences</a></li>
            <li class="list-group-item"><a href="{{ route('export.pdf') }}">📄 Exporter en PDF</a></li>
            <li class="list-group-item"><a href="{{ route('export.excel') }}">📊 Exporter en Excel</a></li>
        </ul>
    </div>
@endsection
