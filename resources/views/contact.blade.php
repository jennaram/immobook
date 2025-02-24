@extends('layouts.app')

@section('content')
    <x-guest-layout>
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{ asset('images/immobook-logo.png') }}" alt="Logo" class="h-16 mx-auto">
        </div>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire de contact -->
        <form method="POST" action="{{ route('contact.submit') }}">
            @csrf

            <!-- Champ Nom -->
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Champ Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Champ Message -->
            <div class="mt-4">
                <x-input-label for="message" :value="__('Message')" />
                <textarea id="message" name="message"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    rows="5" required>{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>

            <!-- Bouton Envoyer -->
            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    {{ __('Envoyer') }}
                </x-primary-button>
            </div>
        </form>
    </x-guest-layout>
@endsection
