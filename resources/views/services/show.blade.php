<!-- resources/views/services/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Détails du service</h1>

    <p><strong>Nom du Service :</strong> {{ $service->nom }}</p>

    <a href="{{ route('services.index') }}">Retour à la liste des services</a>
@endsection
