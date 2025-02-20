<?php

namespace App\Http\Controllers;

use App\Models\Property; // Importez le modèle Property

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::distinct()->get(); // Utilisation de distinct()

        return view('welcome', compact('properties')); // Passez les propriétés à la vue 'welcome'
    }
}