<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Affiche le formulaire de contact
    public function show()
    {
        return view('contact');
    }

    // Traite la soumission du formulaire
    public function submit(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Rediriger vers la page de contact avec un message de succès
        return redirect()->route('contact')->with('success', 'Votre message a bien été envoyé !');
    }
}