<?php

namespace App\Http\Controllers;

use App\Models\Property; // Assurez-vous d'importer le modèle Property
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Affiche la liste des propriétés.
     */
    public function index()
    {
        $properties = Property::all(); // Récupère toutes les propriétés
        return view('properties.index', compact('properties')); // Retourne la vue avec les propriétés
    }

    /**
     * Affiche le formulaire de création d'une nouvelle propriété.
     */
    public function create()
    {
        return view('properties.create'); // Retourne la vue du formulaire de création
    }

    /**
     * Enregistre une nouvelle propriété dans la base de données.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            // ... autres champs ...
        ]);

        // Créer et enregistrer la propriété
        Property::create($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Propriété créée avec succès.');
    }

    /**
     * Affiche les détails d'une propriété spécifique.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property')); // Retourne la vue avec les détails de la propriété
    }

    /**
     * Affiche le formulaire de modification d'une propriété spécifique.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property')); // Retourne la vue du formulaire de modification
    }

    /**
     * Met à jour une propriété spécifique dans la base de données.
     */
    public function update(Request $request, Property $property)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            // ... autres champs ...
        ]);

        // Mettre à jour la propriété
        $property->update($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Propriété mise à jour avec succès.');
    }

    /**
     * Supprime une propriété spécifique de la base de données.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Propriété supprimée avec succès.');
    }
}