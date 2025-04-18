@extends('layouts.app')

@section('content')
    <h1>Créer un service</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <label for="nom">Nom du service :</label>
        <input type="text" name="nom" value="{{ old('nom') }}" required><br><br>

        <button type="submit">Créer</button>
    </form>

    <a href="{{ route('services.index') }}">← Retour à la liste</a>
@endsection
