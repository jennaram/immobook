<?php

namespace App\Http\Controllers;

use App\Models\Booking; // Assurez-vous d'importer le modèle Booking
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Affiche la liste des réservations.
     */
    public function index()
    {
        $bookings = Booking::all(); // Récupère toutes les réservations
        return view('bookings.index', compact('bookings')); // Retourne la vue avec les réservations
    }

    /**
     * Affiche le formulaire de création d'une nouvelle réservation.
     */
    public function create()
    {
        return view('bookings.create'); // Retourne la vue du formulaire de création
    }

    /**
     * Enregistre une nouvelle réservation dans la base de données.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'property_id' => 'required|exists:properties,id', // Clé étrangère vers la table properties
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // ... autres champs ...
        ]);

        // Créer et enregistrer la réservation
        Booking::create($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Affiche les détails d'une réservation spécifique.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking')); // Retourne la vue avec les détails de la réservation
    }

    /**
     * Affiche le formulaire de modification d'une réservation spécifique.
     */
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking')); // Retourne la vue du formulaire de modification
    }

    /**
     * Met à jour une réservation spécifique dans la base de données.
     */
    public function update(Request $request, Booking $booking)
    {
        // Valider les données du formulaire
        $request->validate([
            'property_id' => 'required|exists:properties,id', // Clé étrangère vers la table properties
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // ... autres champs ...
        ]);

        // Mettre à jour la réservation
        $booking->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Supprime une réservation spécifique de la base de données.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}