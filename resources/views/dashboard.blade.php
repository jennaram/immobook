<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
</x-app-layout>