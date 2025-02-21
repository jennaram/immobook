<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Affiche la liste des propriétés.
     */
    public function index()
    {
        $properties = Property::paginate(10); // Pagination pour améliorer les performances
        return view('properties.index', compact('properties'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle propriété.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Enregistre une nouvelle propriété dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données (ajoutez les règles pour tous les champs)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // Exemple : description peut être nulle
            'price_per_night' => 'required|numeric|min:0', // Exemple : prix doit être un nombre positif
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'rooms' => 'nullable|integer|min:0',
            'surface' => 'nullable|numeric|min:0',
            // ... autres champs ...
        ]);

        Property::create($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Propriété créée avec succès.');
    }

    /**
     * Affiche les détails d'une propriété spécifique.
     */
    public function show(Property $property) 
    {
        // Retourne la vue avec les détails de la propriété
        return view('properties.show', compact('property'));
    }

    /**
     * Affiche le formulaire de modification d'une propriété spécifique.
     */
    public function edit(Property $property) // Utilisation de la résolution implicite de modèle
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Met à jour une propriété spécifique dans la base de données.
     */
    public function update(Request $request, Property $property) // Utilisation de la résolution implicite de modèle
    {
        // Validation des données (ajoutez les règles pour tous les champs)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'country' => 'nullable|string',
            'rooms' => 'nullable|integer|min:0',
            'surface' => 'nullable|numeric|min:0',
            // ... autres champs ...
        ]);

        $property->update($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'Propriété mise à jour avec succès.');
    }

    /**
     * Supprime une propriété spécifique de la base de données.
     */
    public function destroy(Property $property) // Utilisation de la résolution implicite de modèle
    {
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Propriété supprimée avec succès.');
    }
}