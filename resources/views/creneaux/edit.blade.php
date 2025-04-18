@extends('layouts.app')

@section('content')
    <h1>Modifier un créneau</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('creneaux.update', $creneau->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nom :</label>
        <input type="text" name="nom" value="{{ $creneau->nom }}">

        <label>Heure de début :</label>
        <input type="time" name="heure_debut" value="{{ $creneau->heure_debut }}">

        <label>Heure de fin :</label>
        <input type="time" name="heure_fin" value="{{ $creneau->heure_fin }}">

        <label>Utilisateurs affectés :</label><br>
        @foreach($users as $user)
            <label>
                <input type="checkbox" name="users[]" value="{{ $user->id }}"
                    {{ $creneau->users->contains($user->id) ? 'checked' : '' }}>
                {{ $user->name }}
            </label><br>
        @endforeach

        <button class="btn btn-sm btn-warning">Mettre à jour</button>
    </form>
