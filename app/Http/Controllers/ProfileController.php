<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;



class ProfileController extends Controller
{
    /**
     * Affiche le formulaire de profil de l'utilisateur.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user(); // Récupérer l'utilisateur connecté

        return view('profile.edit', compact('user')); // Passer l'utilisateur à la vue
    }

    /**
     * Met à jour les informations de profil de l'utilisateur.
     */
    public function update(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
        ]);

        $user = Auth::user();

        // Utiliser la méthode fill() pour attribuer les valeurs de la requête HTTP aux attributs du modèle
        $user->fill($request->all()); // ou $user->fill($request->only('name', 'email')); si vous avez d'autres champs

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

   

    /**
     * Supprime le compte de l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}