@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <main class="container mx-auto px-6 py-8 mb-8">
            <!-- Filtres et tris alignés à droite -->
            <div class="flex justify-end space-x-4 mb-6">
                <!-- Filtre par type de propriété -->
                <select id="filter-by-type"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Tous les types</option>
                    <option value="maison">Maison</option>
                    <option value="appartement">Appartement</option>
                    <option value="villa">Villa</option>
                    <option value="autre">Autre</option>
                </select>
                <!-- Tri par prix -->
                <select id="sort-by"
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="price-asc">Prix croissant</option>
                    <option value="price-desc">Prix décroissant</option>
                </select>
                <!-- Bouton Réinitialiser -->
                <button id="reset-filters"
                    class="px-3 py-1.5 bg-gray-100 border border-gray-300 rounded-md text-sm shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    Réinitialiser
                </button>
            </div>

            <!-- Grille des propriétés -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="properties-container">
                @foreach ($properties as $property)
                    <div class="property bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300"
                        data-price="{{ $property->price_per_night }}"
                        data-type="{{ strpos(strtolower($property->name), 'maison') !== false
                            ? 'maison'
                            : (strpos(strtolower($property->name), 'appartement') !== false
                                ? 'appartement'
                                : (strpos(strtolower($property->name), 'villa') !== false
                                    ? 'villa'
                                    : 'autre')) }}">
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
                                <button onclick="toggleDescription({{ $property->id }})"
                                    class="text-blue-600 hover:text-blue-800 text-sm mt-2 focus:outline-none read-more-btn"
                                    id="btn-{{ $property->id }}">
                                    Lire la suite
                                </button>
                            </div>
                            <!-- Prix et bouton de détails -->
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-bold text-gray-800">{{ $property->price_per_night }} €/nuit</p>
                                    <p class="text-sm text-gray-600">{{ $property->bedrooms }} chambres</p>
                                </div>
                                <a href="{{ route('properties.show', $property) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-black font-medium rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    <!-- Scripts JavaScript -->
    <script>
        // Fonction pour basculer l'affichage de la description
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

            // Gestion des filtres et tris
            const propertiesContainer = document.getElementById('properties-container');
            const properties = Array.from(propertiesContainer.getElementsByClassName('property'));

            const sortBy = document.getElementById('sort-by');
            const filterByType = document.getElementById('filter-by-type');
            const resetFilters = document.getElementById('reset-filters');

            function updateProperties() {
                const sortValue = sortBy.value;
                const filterValue = filterByType.value;

                // Filtrer par type
                let filteredProperties = properties;
                if (filterValue !== 'all') {
                    filteredProperties = properties.filter(property => {
                        const propertyType = property.dataset.type.toLowerCase(); // Convertir en minuscules
                        return propertyType === filterValue;
                    });
                }

                // Trier par prix
                if (sortValue === 'price-asc') {
                    filteredProperties.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
                } else if (sortValue === 'price-desc') {
                    filteredProperties.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
                }

                // Mettre à jour l'affichage
                propertiesContainer.innerHTML = ''; // Vider le conteneur
                filteredProperties.forEach(property => {
                    propertiesContainer.appendChild(property); // Ajouter chaque propriété filtrée
                });

                // Logs pour déboguer
                console.log("Filtre sélectionné :", filterValue);
                console.log("Propriétés filtrées :", filteredProperties);
            }

            // Appliquer les filtres et tris lors du changement
            sortBy.addEventListener('change', updateProperties);
            filterByType.addEventListener('change', updateProperties);

            // Réinitialiser les filtres
            resetFilters.addEventListener('click', function() {
                sortBy.value = 'all'; // Réinitialiser le tri par défaut
                filterByType.value = 'all'; // Réinitialiser le filtre par défaut
                updateProperties(); // Mettre à jour l'affichage
            });
        });
    </script>
@endsection
