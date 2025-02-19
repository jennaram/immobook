<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de la propriété
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4">
                        <a href="{{ route('properties.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700">{{ $property->description }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-700">Prix par nuit : {{ $property->price_per_night }}</p>
                    </div>

                    {{--  Ajouter d'autres détails ici si nécessaire --}}

                    {{--  Exemple : Afficher les réservations liées à cette propriété --}}
                    @if ($property->bookings->count() > 0)
                        <div class="mt-6">
                            <h4 class="text-md font-bold">Réservations</h4>
                            <ul>
                                @foreach ($property->bookings as $booking)
                                    <li>
                                        Du {{ $booking->check_in }} au {{ $booking->check_out }}
                                        {{--  Ajouter d'autres détails de réservation --}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>