@extends('layouts.app')

@section('content')
    <h1>Modifier le service</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nom">Nom du service :</label>
        <input type="text" name="nom" value="{{ old('nom', $service->nom) }}" required><br><br>

        <button class="btn btn-sm btn-warning">Mettre à jour</button>
    </form>

    <a href="{{ route('services.index') }}">← Retour à la liste</a>
@endsection
