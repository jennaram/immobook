<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Affiche la liste des propriétés avec la recherche.
     */
    public function index(Request $request) // Ajout de Request pour gérer la recherche
    {
        $query = Property::query();

        // Vérifie si une recherche a été effectuée
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $properties = $query->paginate(10); // Pagination

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
        // Validation des données
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
        return view('properties.show', compact('property'));
    }

    /**
     * Affiche le formulaire de modification d'une propriété spécifique.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Met à jour une propriété spécifique dans la base de données.
     */
    public function update(Request $request, Property $property)
    {
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
        ]);

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
