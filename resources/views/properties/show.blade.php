@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4">
                        <a href="{{ route('properties.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-indigo-600">{{ $property->name }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Description :</strong> {{ $property->description ?? 'Non renseignée' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Prix par nuit :</strong> {{ $property->price_per_night ?? 'Non renseigné' }} €</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Adresse :</strong> {{ $property->address ?? 'Non renseignée' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Ville :</strong> {{ $property->city ?? 'Non renseignée' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Code postal :</strong> {{ $property->postal_code ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Pays :</strong> {{ $property->country ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Nombre de pièces :</strong> {{ $property->rooms ?? 'Non renseigné' }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700"><strong>Superficie :</strong> {{ $property->surface ?? 'Non renseignée' }} m²</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-gray-700">
                                <strong>Type de propriété :</strong> {{ $property->propertyType->name ?? 'Non renseigné' }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-6">
                        @livewire('booking-manager', ['property' => $property])
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection