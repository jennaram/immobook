<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Affiche la liste des réservations.
     */
    public function index()
    {
        $bookings = Booking::paginate(10); // Pagination pour améliorer les performances
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle réservation.
     */
    public function create()
    {
        // Récupérer les propriétés et les utilisateurs pour les listes déroulantes
        $properties = \App\Models\Property::all(); // Assurez-vous d'importer le modèle Property
        $users = \App\Models\User::all(); // Assurez-vous d'importer le modèle User
        return view('bookings.create', compact('properties', 'users'));
    }

    /**
     * Enregistre une nouvelle réservation dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données (ajoutez les règles pour tous les champs)
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'user_id' => 'required|exists:users,id', // Validation pour l'utilisateur
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            // ... autres champs ...
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Affiche les détails d'une réservation spécifique.
     */
    public function show(Booking $booking) // Utilisation de la résolution implicite de modèle
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Affiche le formulaire de modification d'une réservation spécifique.
     */
    public function edit(Booking $booking) // Utilisation de la résolution implicite de modèle
    {
        // Récupérer les propriétés et les utilisateurs pour les listes déroulantes
        $properties = \App\Models\Property::all();
        $users = \App\Models\User::all();
        return view('bookings.edit', compact('booking', 'properties', 'users'));
    }

    /**
     * Met à jour une réservation spécifique dans la base de données.
     */
    public function update(Request $request, Booking $booking) // Utilisation de la résolution implicite de modèle
    {
        // Validation des données (ajoutez les règles pour tous les champs)
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'user_id' => 'required|exists:users,id', // Validation pour l'utilisateur
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            // ... autres champs ...
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Supprime une réservation spécifique de la base de données.
     */
    public function destroy(Booking $booking) // Utilisation de la résolution implicite de modèle
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}