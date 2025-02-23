@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Réserver une propriété</h1>

                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf

                        <!-- Champ caché pour l'ID de la propriété -->
                        <input type="hidden" name="property_id" value="{{ request('property_id') }}">

                        <!-- Afficher le nom de la propriété si elle est déjà sélectionnée -->
                        @if (request('property_id'))
                            <div class="mb-4">
                                <p class="text-gray-700"><strong>Propriété :</strong> {{ $property->name }}</p>
                                <p class="text-gray-700"><strong>Prix par nuit :</strong> {{ $property->price_per_night }} €</p>
                            </div>
                        @else
                            <!-- Sélection de la propriété -->
                            <div class="mb-4">
                                <label for="property_id" class="block text-gray-700 text-sm font-bold mb-2">Propriété</label>
                                <select name="property_id" id="property_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}" data-price="{{ $property->price_per_night }}">{{ $property->name }}</option>
                                    @endforeach
                                </select>
                                @error('property_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Sélection de l'utilisateur (uniquement pour les administrateurs) -->
                        @if (auth()->user()->is_admin)
                            <div class="mb-4">
                                <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Utilisateur</label>
                                <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @else
                            <!-- Champ caché pour l'ID de l'utilisateur connecté -->
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endif

                        <!-- Date de check-in -->
                        <div class="mb-4">
                            <label for="check_in" class="block text-gray-700 text-sm font-bold mb-2">Date d'arrivée</label>
                            <input type="date" name="check_in" id="check_in" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('check_in')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date de check-out -->
                        <div class="mb-4">
                            <label for="check_out" class="block text-gray-700 text-sm font-bold mb-2">Date de départ</label>
                            <input type="date" name="check_out" id="check_out" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('check_out')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Affichage du prix total calculé -->
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Prix total :</strong> <span id="total_price">0</span> €</p>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-between">
                            <a href="{{ url('/') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Réserver
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour calculer le prix total
        function calculateTotalPrice() {
            const checkIn = new Date(document.getElementById('check_in').value);
            const checkOut = new Date(document.getElementById('check_out').value);

            // Récupérer le prix par nuit
            let pricePerNight;
            const propertySelect = document.getElementById('property_id');
            if (propertySelect) {
                // Cas où la propriété est sélectionnée via le menu déroulant
                pricePerNight = parseFloat(propertySelect.options[propertySelect.selectedIndex].dataset.price);
            } else {
                // Cas où la propriété est présélectionnée (depuis properties/show.blade.php)
                pricePerNight = parseFloat("{{ $property->price_per_night ?? 0 }}");
            }

            console.log('Check-in:', checkIn);
            console.log('Check-out:', checkOut);
            console.log('Prix par nuit:', pricePerNight);

            if (checkIn && checkOut && !isNaN(pricePerNight)) {
                const timeDiff = checkOut.getTime() - checkIn.getTime();
                const nights = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Calcul du nombre de nuits
                const totalPrice = nights * pricePerNight;
                document.getElementById('total_price').textContent = totalPrice.toFixed(2);
            } else {
                document.getElementById('total_price').textContent = '0';
            }
        }

        // Écouteurs d'événements pour recalculer le prix total
        document.getElementById('check_in')?.addEventListener('change', calculateTotalPrice);
        document.getElementById('check_out')?.addEventListener('change', calculateTotalPrice);
        document.getElementById('property_id')?.addEventListener('change', calculateTotalPrice);

        // Calculer le prix total au chargement de la page (si les dates sont déjà remplies)
        document.addEventListener('DOMContentLoaded', calculateTotalPrice);
    </script>
@endsection