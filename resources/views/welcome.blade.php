@extends('layouts.app')

@section('content')
    <div class="min-h-screen">
        <header class="bg-white shadow">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="text-2xl font-semibold text-gray-800">Immobook</div>
                <nav class="flex space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">Inscription</a>
                        @endif
                    @endguest
                </nav>
            </div>
        </header>

        <main class="container mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Propriétés disponibles</h1>

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

        <footer class="bg-white shadow mt-8">
            <div class="container mx-auto px-6 py-4 text-center text-gray-600">
                &copy; {{ date('Y') }} Immobook. Tous droits réservés.
            </div>
        </footer>
    </div>
@endsection