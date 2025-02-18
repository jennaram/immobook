<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Property; // Import the Property model
use App\Models\Booking; // Import the Booking model
use Illuminate\Support\Facades\Validator; // For validation

class BookingManager extends Component
{
    public $property_id;
    public $start_date;
    public $end_date;
    public $num_guests = 1; // Default number of guests
    public $availableProperties; // To store available properties
    public $bookingSuccessful = false;
    public $bookingMessage = '';

    public function mount()
    {
        // Initialize available properties (you might want to refine this query)
        $this->availableProperties = Property::all(); // Or a more specific query
    }


    public function book()
    {
        $rules = [
            'property_id' => 'required|exists:properties,id', // Check if property exists
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'num_guests' => 'required|integer|min:1',
        ];

        $messages = [
            'property_id.required' => 'La propriété est requise.',
            'property_id.exists' => 'La propriété sélectionnée n\'existe pas.',
            'start_date.required' => 'La date de début est requise.',
            'start_date.after_or_equal' => 'La date de début doit être aujourd\'hui ou après.',
            'end_date.required' => 'La date de fin est requise.',
            'end_date.after' => 'La date de fin doit être après la date de début.',
            'num_guests.required' => 'Le nombre de personnes est requis.',
            'num_guests.integer' => 'Le nombre de personnes doit être un nombre entier.',
            'num_guests.min' => 'Le nombre de personnes doit être au minimum 1.',
        ];


        $validator = Validator::make([
            'property_id' => $this->property_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'num_guests' => $this->num_guests,
        ], $rules, $messages);

        if ($validator->fails()) {
            $this->dispatchBrowserEvent('booking-failed', ['errors' => $validator->errors()]);
            return; // Stop execution if validation fails
        }


        // Check for availability (this is a simplified example)
        $existingBooking = Booking::where('property_id', $this->property_id)
            ->whereBetween('start_date', [$this->start_date, $this->end_date])
            ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
            ->exists();

        if ($existingBooking) {
            $this->dispatchBrowserEvent('booking-failed', ['customMessage' => 'Cette propriété n\'est pas disponible aux dates sélectionnées.']);
            return;
        }


        try {
            // Create the booking
            Booking::create([
                'property_id' => $this->property_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'num_guests' => $this->num_guests,
                // Add other booking details as needed (e.g., user_id)
            ]);

            $this->bookingSuccessful = true;
            $this->bookingMessage = 'Réservation réussie !';
            $this->reset(['property_id', 'start_date', 'end_date', 'num_guests']); // Clear the form

            $this->dispatchBrowserEvent('booking-successful', ['message' => 'Réservation réussie !']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('booking-failed', ['customMessage' => 'Une erreur s\'est produite lors de la réservation. Veuillez réessayer.']);
            // Log the error for debugging:
            // Log::error($e);
        }
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}