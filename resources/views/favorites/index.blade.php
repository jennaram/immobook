@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Mes Propriétés Favorites</h1>

                    @if ($favorites->isEmpty())
                        <p class="text-gray-600">Vous n'avez aucune propriété en favoris.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($favorites as $favorite)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <h2 class="text-xl font-semibold">{{ $favorite->property->name }}</h2>
                                    <p class="text-gray-700">{{ $favorite->property->description }}</p>
                                    <p class="text-gray-700"><strong>Prix par nuit :</strong>
                                        {{ $favorite->property->price_per_night }} €</p>
                                    <div class="mt-4">
                                        <a href="{{ route('properties.show', $favorite->property) }}"
                                            class="text-blue-600 hover:text-blue-800">Voir plus</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $favorites->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
