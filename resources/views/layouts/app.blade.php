<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Immobook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ open: false }" class="bg-gray-100">

    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/immobook-logo.png') }}" alt="Immobook Logo"
                                class="block h-9 w-auto">
                        </a>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                        <!-- Lien "À propos" -->
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            À propos
                        </x-nav-link>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Tableau de bord
                        </x-nav-link>
                        <x-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.*')">
                            Propriétés
                        </x-nav-link>
                        <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                            Réservations
                        </x-nav-link>
                    </div>
                </div>

                <!-- favoris-->
                <div class="flex items-center">
                    <a href="{{ route('favorites.index') }}" class="relative text-gray-700 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <span id="favorite-count"
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                            {{ Auth::check() ? Auth::user()->favorites()->count() : 0 }}
                        </span>
                    </a>
                </div>

                <!-- Barre de recherche -->
                <div class="flex items-center">
                    <form action="{{ route('home') }}" method="GET" class="relative flex items-center">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                            class="text-sm bg-transparent focus:outline-none placeholder-gray-500 w-48 md:w-64 border border-gray-300 rounded-lg px-3 py-2">

                        <button type="submit"
                            class="ml-2 p-2 text-gray-500 hover:text-gray-700 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35m2.35-5.15a7 7 0 1 1-14 0 7 7 0 0 1 14 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="h-4 w-4 mr-2">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                            class="ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="h-4 w-4 mr-2">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            Inscription
                        </a>
                    @endguest
                    <x-dropdown alignment="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                @if (Auth::check())
                                    <div>{{ Auth::user()->name }}</div>
                                @endif

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content" class="text-right">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    Déconnexion
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Menu mobile -->
                <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            Tableau de bord
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('properties.index')" :active="request()->routeIs('properties.*')">
                            Propriétés
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                            Réservations
                        </x-responsive-nav-link>
                    </div>

                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            @if (Auth::check())
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            @endif
                            <@if (Auth::check())
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                @endif
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                Profil
                            </x-responsive-nav-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                               this.closest('form').submit();">
                                    Déconnexion
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </div>

    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto px-6 py-4 text-center text-gray-600">
            <!-- Ligne 1 : Copyright et lien Contact -->
            <div class="mb-2">
                &copy; {{ date('Y') }} Immobook. Tous droits réservés. |
                <a href="{{ route('contact') }}" class="text-gray-600 hover:text-gray-800">Contact</a>
            </div>

            <!-- Ligne 2 : Logo LinkedIn et texte -->
            <div class="flex items-center justify-center space-x-2">
                <a href="https://www.linkedin.com/in/jennabenufferamia/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/logo_linkedin.png') }}" alt="LinkedIn" class="w-6 h-6">
                </a>
                <a href="https://www.linkedin.com/in/jennabenufferamia/" target="_blank" rel="noopener noreferrer"
                    class="text-gray-600 hover:text-gray-800">
                    Rejoignez-moi sur LinkedIn
                </a>
            </div>
        </div>
    </footer>
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
                    body: JSON.stringify({
                        property_id: propertyId
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Mettre à jour le compteur de favoris
                    document.getElementById('favorite-count').textContent = data.count;

                    // Ajouter ou supprimer la classe "text-red-500" pour l'icône
                    const heartIcon = document.querySelector(`[data-property-id="${propertyId}"]`);
                    if (heartIcon) {
                        heartIcon.classList.toggle('text-red-500', data.action === 'added');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la mise à jour des favoris :', error);
                });
        }
        });
    </script>
</body>

</html>
