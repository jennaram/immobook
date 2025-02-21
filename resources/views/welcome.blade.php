@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <!-- Header reste inchangé -->
        
        <main class="container mx-auto px-6 py-8 mb-8">
            <h1 class="text-3xl font-bold text-white -800 mb-6"> </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($properties as $property)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ $property->image_url }}" alt="{{ $property->name }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800">{{ $property->name }}</h2>
                            
                            <!-- Description avec "lire la suite" -->
                            <div class="mt-2">
                                <div class="description-container" id="description-{{ $property->id }}">
                                    <p class="text-gray-600 description-content">
                                        {{ $property->description }}
                                    </p>
                                </div>
                                <button 
                                    onclick="toggleDescription({{ $property->id }})"
                                    class="text-blue-600 hover:text-blue-800 text-sm mt-2 focus:outline-none read-more-btn"
                                    id="btn-{{ $property->id }}"
                                >
                                    Lire la suite
                                </button>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-bold text-gray-800">{{ $property->price_per_night }} €/nuit</p>
                                    <p class="text-sm text-gray-600">{{ $property->bedrooms }} chambres</p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div></div>
                                    <a href="{{ route('properties.show', $property) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-black font-medium rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Voir les détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    

    <!-- Ajoutez ce script à la fin de votre fichier -->
    <script>
        function toggleDescription(propertyId) {
            const container = document.getElementById(`description-${propertyId}`);
            const button = document.getElementById(`btn-${propertyId}`);
            
            if (container.classList.contains('expanded')) {
                container.classList.remove('expanded');
                button.textContent = 'Lire la suite';
            } else {
                container.classList.add('expanded');
                button.textContent = 'Voir moins';
            }
        }

        // Fonction pour vérifier si le texte est trop long
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.description-container').forEach(container => {
                const content = container.querySelector('.description-content');
                const button = container.nextElementSibling;
                
                if (content.scrollHeight <= container.clientHeight) {
                    button.style.display = 'none';
                }
            });
        });
    </script>
@endsection