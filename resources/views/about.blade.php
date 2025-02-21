@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <!-- Titre centré avec une taille de police augmentée et une marge en haut -->
    <h1 class="text-xl font-bold text-center mb-12 mt-8">Bienvenue sur notre plateforme !</h1>

    <!-- Section principale centrée avec une marge en haut -->
    <div class="bg-white rounded-lg shadow-md p-8 max-w-3xl mx-auto mt-8">
        <!-- Texte centré avec une taille de police augmentée et une marge en haut -->
        <p class="text-lg text-gray-700 text-center mb-6 mt-6">
             <br>Nous sommes une équipe passionnée qui travaille dur pour vous offrir la meilleure expérience possible.
        </p>
        <p class="text-lg text-gray-700 text-center mb-6">
            Notre mission est de simplifier la gestion des propriétés et de rendre votre séjour aussi agréable que possible.
        </p>
        <p class="text-lg text-gray-700 text-center mb-8">
            N'hésitez pas à nous contacter si vous avez des questions ou des suggestions.
        </p>

        <!-- Section Équipe -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Membre de l'équipe 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition-shadow duration-300">
                <a href="https://www.linkedin.com/in/jennabenufferamia/" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('images/logo_linkedin.png') }}" alt="LinkedIn" class="w-20 h-20 rounded-full mx-auto mb-4 hover:scale-110 transition-transform duration-300">
                </a>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Jenna</h3>
                <p class="text-lg text-gray-600">CEO & Fondatrice</p>
            </div>
        </div>
    </div>
</div>
@endsection