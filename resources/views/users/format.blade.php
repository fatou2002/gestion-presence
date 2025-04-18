@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nom complet</label>
    <input type="text" name="name" id="name" class="form-control"
           value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Adresse e-mail</label>
    <input type="email" name="email" id="email" class="form-control"
           value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rôle</label>
    <select name="role" id="role" class="form-control" required>
        <option value="">-- Choisir un rôle --</option>
        <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
        <option value="gestionnaire" {{ (old('role', $user->role ?? '') == 'gestionnaire') ? 'selected' : '' }}>Gestionnaire</option>
        <option value="employe" {{ (old('role', $user->role ?? '') == 'employe') ? 'selected' : '' }}>Employé</option>
    </select>
</div>

<div class="mb-3">
    <label for="service_id" class="form-label">Service</label>
    <select name="service_id" id="service_id" class="form-control">
        <option value="">-- Aucun --</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" {{ (old('service_id', $user->service_id ?? '') == $service->id) ? 'selected' : '' }}>
                {{ $service->nom }}
            </option>
        @endforeach
    </select>
</div>

@if (!isset($user)) {{-- Pour la création uniquement --}}
<div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" id="password" class="form-control" required>
</div>
@endif

<button type="submit" class="btn btn-primary">Enregistrer</button>
