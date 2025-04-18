<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tableau de Bord')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@auth
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">MonApp</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Utilisateurs</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('export.pdf') }}">Export PDF</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('export.excel') }}">Export Excel</a></li>

                        {{-- GESTIONNAIRE --}}
                    @elseif(auth()->user()->role === 'manager')
                        <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('creneaux.index') }}">Créneaux</a></li> {{-- 🔥 ajout ici --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('statistiques') }}">📊 Statistiques</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('export.pdf') }}">Export PDF</a></li>

                        {{-- EMPLOYE --}}
                    @elseif(auth()->user()->role === 'employe')
                        <li class="nav-item"><a class="nav-link" href="{{ route('presences.checkin') }}">Pointer</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('presences.index') }}">Mes présences</a></li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
    <span class="navbar-text text-light">
        Connecté en tant que : <strong>{{ auth()->user()->email }}</strong> ({{ auth()->user()->role }})
    </span>
                    </li>
                    <li class="nav-item ms-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-light" type="submit">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endauth

<main class="container mt-4">
    @yield('content')
</main>
@yield('scripts')
</body>
</html>
