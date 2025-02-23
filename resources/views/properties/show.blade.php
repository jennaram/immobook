@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Bouton "Retour à la liste" -->
                    <div class="mb-4">
                        <a href="{{ route('home') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>

                    <!-- Nom de la propriété -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-black">{{ $property->name }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <!-- Image de la propriété -->
                        <div class="mb-4">
                            <img src="{{ $property->image_url }}" alt="{{ $property->name }}" class="w-full h-64 object-cover rounded-lg">
                        </div>

                        <!-- Description avec "Lire la suite" et "Voir moins" -->
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Description :</strong></p>
                            <div x-data="{ showMore: false }">
                                <div class="relative overflow-hidden transition-all duration-300" :class="showMore ? 'max-h-full' : 'max-h-24'">
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $property->description ?? 'Non renseignée' }}
                                    </p>
                                    <div x-show="!showMore" class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-white via-white/80 to-transparent h-10"></div>
                                </div>
                                
                                <!-- Boutons "Lire la suite" et "Voir moins" -->
                                <button @click="showMore = !showMore" class="text-blue-600 hover:underline mt-2">
                                    <span x-show="!showMore">Lire la suite</span>
                                    <span x-show="showMore">Voir moins</span>
                                </button>
                            </div>
                        </div>

                        <!-- Prix par nuit -->
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Prix par nuit :</strong> {{ $property->price_per_night ?? 'Non renseigné' }} €</p>

                            <!-- Bouton "Favori" -->
                            <div class="mt-4">
                                <button onclick="toggleFavorite({{ $property->id }})" class="text-gray-500 hover:text-red-500">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" data-property-id="{{ $property->id }}">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>
</button>
                            </div>

                            <!-- Bouton "Réserver" sous le prix -->
                            <div class="mt-4 flex justify-center">
                                @auth
                                    <!-- Utilisateur connecté : rediriger vers le formulaire de réservation -->
                                    <a href="{{ route('bookings.create', ['property_id' => $property->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Réserver
                                    </a>
                                @else
                                    <!-- Utilisateur non connecté : afficher un message avec des liens de connexion et d'inscription -->
                                    <div class="text-center mt-2">
                                        <p class="text-gray-600">Vous devez être connecté pour réserver cette propriété.</p>
                                        <div class="mt-2 space-x-4">
                                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Se connecter</a>
                                            <span class="text-gray-400">|</span>
                                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">S'inscrire</a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Adresse :</strong> {{ $property->address ?? 'Non renseignée' }}</p>
                        </div>

                        <!-- Nombre de chambres -->
                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Nombre de chambres :</strong> {{ $property->bedrooms ?? 'Non renseigné' }}</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Script JavaScript pour la gestion des favoris -->
    <script>
        // Fonction pour basculer un favori
        function toggleFavorite(propertyId) {
            fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ property_id: propertyId }),
            })
            .then(response => response.json())
            .then(data => {
                // Mettre à jour le compteur de favoris dans le header
                document.getElementById('favorite-count').textContent = data.count;

                // Ajouter ou supprimer la classe "text-red-500" pour l'icône de cœur
                const heartIcon = document.querySelector(`[data-property-id="${propertyId}"]`);
                if (heartIcon) {
                    heartIcon.classList.toggle('text-red-500', data.action === 'added');
                }
            });
        }
    </script>
@endsection