<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les propriétés
        $properties = Property::all(); // Ou une logique personnalisée pour récupérer les propriétés

        // Passer les propriétés à la vue
        return view('welcome', compact('properties'));
    }
}