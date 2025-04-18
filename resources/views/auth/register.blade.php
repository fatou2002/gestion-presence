@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Créer un compte</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Nom</label>
                <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label>Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="mb-3">
                <label>Rôle</label>
                <select class="form-control" name="role" required>
                    <option value="">-- Choisir un rôle --</option>
                    <option value="admin">Admin</option>
                    <option value="gestionnaire">Gestionnaire</option>
                    <option value="employe">Employé</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">S'enregistrer</button>
        </form>
    </div>
@endsection
