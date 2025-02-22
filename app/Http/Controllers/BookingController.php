<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected function middleware(): array
    {
        return ['auth'];
    }

    /**
     * Affiche la liste des réservations.
     */
    public function index()
{
    // Vérifier si l'utilisateur est un administrateur
    if (Auth::user()->is_admin) {
        // Si l'utilisateur est un administrateur, afficher toutes les réservations
        $bookings = Booking::with(['property', 'user'])->paginate(10);
    } else {
        // Sinon, afficher uniquement les réservations de l'utilisateur connecté
        $bookings = Booking::where('user_id', Auth::id())->with(['property', 'user'])->paginate(10);
    }

    return view('bookings.index', compact('bookings'));
}

    /**
     * Affiche le formulaire de création d'une nouvelle réservation.
     */
    public function create(Request $request)
    {
        // Récupérer l'ID de la propriété depuis l'URL
        $propertyId = $request->query('property_id');

        // Récupérer la propriété si l'ID est fourni
        $property = $propertyId ? Property::findOrFail($propertyId) : null;

        // Récupérer les propriétés pour la liste déroulante
        $properties = Property::all();
        
        // Récupérer la liste des utilisateurs pour les administrateurs
        $users = User::all(); 
        
        return view('bookings.create', compact('property', 'properties', 'users'));
    }

    /**
     * Enregistre une nouvelle réservation dans la base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Associer l'utilisateur connecté à la réservation
        $request->merge(['user_id' => Auth::id()]);

        // Créer la réservation
        Booking::create([
            'property_id' => $request->property_id,
            'user_id' => $request->user_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending', // Ajoutez une valeur par défaut pour `status`
        ]);

        return redirect()->route('bookings.index')->with('success', 'Réservation effectuée avec succès !');
    }

    /**
     * Affiche les détails d'une réservation spécifique.
     */
    public function show(Booking $booking)
{
    // Vérifier si l'utilisateur est un administrateur ou le propriétaire de la réservation
    if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
        return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour accéder à cette réservation.');
    }

    return view('bookings.show', compact('booking'));
}

    /**
     * Affiche le formulaire de modification d'une réservation spécifique.
     */
    public function edit(Booking $booking)
{
    // Vérifier si l'utilisateur est un administrateur ou le propriétaire de la réservation
    if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
        return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour modifier cette réservation.');
    }

    // Récupérer les propriétés pour la liste déroulante
    $properties = Property::all();
    return view('bookings.edit', compact('booking', 'properties'));
}

    /**
     * Met à jour une réservation spécifique dans la base de données.
     */
    public function update(Request $request, Booking $booking)
{
    // Vérifier si l'utilisateur est un administrateur ou le propriétaire de la réservation
    if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
        return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour modifier cette réservation.');
    }

    // Validation des données
    $request->validate([
        'property_id' => 'required|exists:properties,id',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        
    ]);

    // Mettre à jour la réservation
    $booking->update($request->all());

    return redirect()->route('bookings.index')->with('success', 'Réservation mise à jour avec succès.');
}

    /**
     * Supprime une réservation spécifique de la base de données.
     */
    public function destroy(Booking $booking)
{
    // Vérifier si l'utilisateur est un administrateur ou le propriétaire de la réservation
    if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
        return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour supprimer cette réservation.');
    }

    // Supprimer la réservation
    $booking->delete();

    return redirect()->route('bookings.index')->with('success', 'Réservation supprimée avec succès.');
}
}