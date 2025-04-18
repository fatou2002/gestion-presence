@extends('layouts.app')

@section('content')
    <h1>Liste des services</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('services.create') }}" class="btn btn-success mb-3"> ➕Ajouter un nouveau service</a>

    <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{ $service->nom }}</td>
                <td>
                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet service ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
