@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Message de bienvenue en fonction du rôle -->
                    @if (auth()->user()->is_admin)
                        <div class="bg-blue-100 p-4 rounded-lg mb-6">
                            <p class="text-blue-800">Bienvenue, administrateur !</p>
                            
                        </div>
                    @else
                        <div class="bg-green-100 p-4 rounded-lg mb-6">
                            <p class="text-green-800">Bienvenue, utilisateur !</p>
                        </div>
                    @endif

                    <!-- Historique des réservations -->
                    <h3 class="text-lg font-semibold mb-4">Historique des réservations</h3>

                    <!-- Réservations à venir -->
                    <div class="mb-8">
                        <h4 class="text-md font-semibold mb-2">Réservations à venir</h4>
                        @if ($upcomingBookings->isEmpty())
                            <p class="text-gray-600">Aucune réservation à venir.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b">Propriété</th>
                                            <th class="py-2 px-4 border-b">Date d'arrivée</th>
                                            <th class="py-2 px-4 border-b">Date de départ</th>
                                            <th class="py-2 px-4 border-b">Prix total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($upcomingBookings as $booking)
                                            <tr>
                                                <td class="py-2 px-4 border-b">{{ $booking->property->name }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->start_date->format('d/m/Y') }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->end_date->format('d/m/Y') }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->total_price }} €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- Réservations passées -->
                    <div>
                        <h4 class="text-md font-semibold mb-2">Réservations passées</h4>
                        @if ($pastBookings->isEmpty())
                            <p class="text-gray-600">Aucune réservation passée.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr>
                                            <th class="py-2 px-4 border-b">Propriété</th>
                                            <th class="py-2 px-4 border-b">Date d'arrivée</th>
                                            <th class="py-2 px-4 border-b">Date de départ</th>
                                            <th class="py-2 px-4 border-b">Prix total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pastBookings as $booking)
                                            <tr>
                                                <td class="py-2 px-4 border-b">{{ $booking->property->name }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->start_date->format('d/m/Y') }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->end_date->format('d/m/Y') }}</td>
                                                <td class="py-2 px-4 border-b">{{ $booking->total_price }} €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection