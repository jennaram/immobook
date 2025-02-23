<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateBookingPrices extends Command
{
    protected $signature = 'bookings:update-prices';
    protected $description = 'Mettre à jour les prix des réservations existantes';

    public function handle()
    {
        $bookings = Booking::whereNull('total_price')->get();

        foreach ($bookings as $booking) {
            // Récupérer la propriété associée
            $property = Property::find($booking->property_id);

            if ($property) {
                // Convertir les dates en objets Carbon
                $checkIn = Carbon::parse($booking->check_in);
                $checkOut = Carbon::parse($booking->check_out);

                // Calculer le nombre de nuits
                $nights = $checkIn->diffInDays($checkOut);

                // Calculer le prix total
                $totalPrice = $nights * $property->price_per_night;

                // Mettre à jour la réservation
                $booking->total_price = $totalPrice;
                $booking->save();
            }
        }

        $this->info('Prix des réservations mis à jour avec succès.');
    }
}