<?php

namespace App\Http\Controllers;

use App\Models\Property; // Importez le modèle Property

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::all(); // Récupérez toutes les propriétés depuis la base de données

        return view('welcome', compact('properties')); // Passez les propriétés à la vue 'welcome'
    }
}