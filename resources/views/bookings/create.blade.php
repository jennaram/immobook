@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="property_id" value="{{ request('property_id') }}">
    <!-- Autres champs du formulaire -->
    <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Réserver</button>
</form>

                        <!-- Sélection de la propriété -->
                        <div class="mb-4">
                            <label for="property_id" class="block text-gray-700 text-sm font-bold mb-2">Propriété</label>
                            <select name="property_id" id="property_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach ($properties as $property)
                                    <option value="{{ $property->id }}">{{ $property->name }}</option>
                                @endforeach
                            </select>
                            @error('property_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

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
                            <label for="check_in" class="block text-gray-700 text-sm font-bold mb-2">Check-in</label>
                            <input type="date" name="check_in" id="check_in" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('check_in')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date de check-out -->
                        <div class="mb-4">
                            <label for="check_out" class="block text-gray-700 text-sm font-bold mb-2">Check-out</label>
                            <input type="date" name="check_out" id="check_out" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            @error('check_out')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-between">
                            <a href="{{ url('/') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Annuler
                            </a>
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Enregistrer
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection