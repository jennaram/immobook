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
        $bookings = Booking::paginate(10); // Pagination pour améliorer les performances
        return view('bookings.index', compact('bookings'));
    }

    /**
 * Affiche le formulaire de création d'une nouvelle réservation.
 */
public function create()
{
    // Récupérer les propriétés pour la liste déroulante
    $properties = Property::all();
    
    // Récupérer la liste des utilisateurs pour les administrateurs
    $users = User::all(); // N'oubliez pas d'ajouter l'import : use App\Models\User;
    
    return view('bookings.create', compact('properties', 'users'));
}

    /**
     * Enregistre une nouvelle réservation dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // Associer l'utilisateur connecté à la réservation
        $request->merge(['user_id' => Auth::id()]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Affiche les détails d'une réservation spécifique.
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    /**
     * Affiche le formulaire de modification d'une réservation spécifique.
     */
    public function edit(Booking $booking)
    {
        // Vérifier si l'utilisateur est administrateur ou propriétaire de la réservation
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
        // Vérifier si l'utilisateur est administrateur ou propriétaire de la réservation
        if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
            return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour modifier cette réservation.');
        }

        // Validation des données
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Supprime une réservation spécifique de la base de données.
     */
    public function destroy(Booking $booking)
    {
        // Vérifier si l'utilisateur est administrateur ou propriétaire de la réservation
        if (!Auth::user()->is_admin && Auth::user()->id !== $booking->user_id) {
            return redirect()->route('bookings.index')->with('error', 'Vous n\'avez pas les droits pour supprimer cette réservation.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }
}