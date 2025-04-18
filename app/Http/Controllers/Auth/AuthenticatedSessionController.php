<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
public function create()
{
return view('auth.login'); // Crée une vue auth/login.blade.php
}

    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            session()->flash('login_message', "Connecté ! Utilisateur : {$user->email} | Rôle : {$user->role}");

            // 🔄 Redirection vers la bonne vue déjà existante
            if ($user->role === 'admin') {
                return view('dashboard.admin');
            } elseif ($user->role === 'manager') {
                return view('dashboard.manager');
            } elseif ($user->role === 'employe') {
                return view('dashboard.employe');
            }

            return view('dashboard.index'); // fallback (si tu as une page générique)
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }


public function destroy(Request $request)
{
Auth::logout(); // Déconnexion de l'utilisateur

$request->session()->invalidate(); // Invalidation de la session
$request->session()->regenerateToken(); // Régénérer le token CSRF pour la sécurité

return redirect('/login'); // Redirection vers la page de login après déconnexion
}
}
