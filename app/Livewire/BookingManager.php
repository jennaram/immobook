<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property;
use App\Models\Booking; // Importez le modèle Booking
use Illuminate\Validation\Rule; // Pour les règles de validation uniques

class BookingManager extends Component
{
    public Property $property;
    public $bookings;
    public $newBooking = []; // Pour le formulaire de création
    public $editingBooking = null; // Pour le formulaire de modification
    public $showCreateForm = false; // Pour afficher/masquer le formulaire de création

    public function mount(Property $property)
    {
        $this->property = $property;
        $this->loadBookings(); // Charger les réservations au montage du composant
    }

    public function loadBookings()
    {
        $this->bookings = $this->property->bookings->load('user'); // Charger les réservations et l'utilisateur lié
    }

    public function createBooking()
    {
        $this->showCreateForm = true; // Afficher le formulaire de création
        $this->newBooking = [
            'property_id' => $this->property->id,
            'check_in' => now()->format('Y-m-d'), // Date de début par défaut
            'check_out' => now()->addDays(1)->format('Y-m-d'), // Date de fin par défaut (1 jour plus tard)
        ];
    }

    public function storeBooking()
    {
        $this->validate($this->newBooking, [
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'user_id' => 'required|exists:users,id',
            // ... autres règles de validation ...
        ]);

        Booking::create($this->newBooking);
        $this->loadBookings(); // Recharger les réservations après la création
        $this->newBooking = []; // Réinitialiser le formulaire
        $this->showCreateForm = false; // Masquer le formulaire
        session()->flash('success', 'Réservation créée avec succès.'); // Message flash
    }

    public function editBooking(Booking $booking)
    {
        $this->editingBooking = $booking; // Définir la réservation à modifier
    }

    public function updateBooking()
    {
        $this->validate($this->editingBooking, [
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'user_id' => 'required|exists:users,id',
            // ... autres règles de validation ...
        ]);
        $this->editingBooking->save();
        $this->loadBookings(); // Recharger les réservations après la modification
        $this->editingBooking = null; // Réinitialiser la variable d'édition
        session()->flash('success', 'Réservation mise à jour avec succès.'); // Message flash

    }

    public function deleteBooking(Booking $booking)
    {
        $booking->delete();
        $this->loadBookings(); // Recharger les réservations après la suppression
        session()->flash('success', 'Réservation supprimée avec succès.'); // Message flash
    }

    public function cancelEdit()
    {
        $this->editingBooking = null; // Annuler la modification
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}