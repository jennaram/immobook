<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Immobook - Réservation de propriétés</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- En-tête -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="text-2xl font-semibold text-gray-800">Immobook</div>
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-800 hover:text-gray-600">Tableau de bord</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">Inscription</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Contenu Principal -->
        <main class="container mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Propriétés disponibles</h1>

            <!-- Liste des propriétés -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($properties as $property)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $property->image_url }}" alt="{{ $property->name }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800">{{ $property->name }}</h2>
                <p class="text-gray-600 mt-2">{{ $property->description }}</p>
                <p class="text-lg font-bold text-gray-800 mt-4">{{ $property->price_per_night }} €/nuit</p>
                <a href="{{ route('properties.show', $property->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Réserver</a>
            </div>
        </div>
    @endforeach
</div>

            <!-- Formulaire de réservation (exemple pour une propriété spécifique) -->
            <div class="mt-12 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Réserver une propriété</h2>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="property_id" class="block text-gray-700">Propriété</label>
                            <select name="property_id" id="property_id" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="start_date" class="block text-gray-700">Date d'arrivée</label>
                            <input type="date" name="start_date" id="start_date" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label for="end_date" class="block text-gray-700">Date de départ</label>
                            <input type="date" name="end_date" id="end_date" class="w-full mt-2 p-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>
                    <button type="submit" class="mt-6 bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Réserver</button>
                </form>
            </div>
        </main>

        <!-- Pied de page -->
        <footer class="bg-white shadow mt-8">
            <div class="container mx-auto px-6 py-4 text-center text-gray-600">
                &copy; {{ date('Y') }} Immobook. Tous droits réservés.
            </div>
        </footer>
    </div>
</body>
</html>