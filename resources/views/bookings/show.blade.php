@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4">
                        <a href="{{ route('bookings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700"><strong>Propriété :</strong> {{ $booking->property->name }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700"><strong>Utilisateur :</strong> {{ $booking->user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700"><strong>Check-in :</strong> {{ $booking->check_in }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700"><strong>Check-out :</strong> {{ $booking->check_out }}</p>
                    </div>

                    @if ($booking->property)
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Description de la propriété :</strong> {{ $booking->property->description }}</p>
                            <p class="text-gray-700"><strong>Prix par nuit :</strong> {{ $booking->property->price_per_night }}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection