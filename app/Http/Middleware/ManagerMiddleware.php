<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next)
    {


        if (Auth::check() && Auth::user()->role === 'manager') {
            // Tu peux loguer ici pour debug :
            // logger('ManagerMiddleware bien exécuté ✅');
            return $next($request);
        }

        // Sinon on redirige (vers le login ou une page d'erreur)
        abort(403, 'Accès refusé. Seuls les managers peuvent accéder à cette page.');
    }
}
