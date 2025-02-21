<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est un administrateur
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Rediriger les utilisateurs non administrateurs
        return redirect('/')->with('error', 'Vous n\'avez pas accès à cette page.');
    }
}