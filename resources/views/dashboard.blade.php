@php
    $role = session('role');
    $color = match($role) {
        'admin' => 'danger',
        'gestionnaire' => 'warning',
        'employe' => 'success',
        default => 'secondary'
    };
@endphp

@if($role)
    <div class="alert alert-{{ $color }}">
        ✅ Vous êtes connecté en tant que <strong>{{ ucfirst($role) }}</strong>.
    </div>
@endif
