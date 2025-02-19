<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route d'accueil
Route::get('/', function () {
    return view('welcome'); // Ou une autre vue pour votre page d'accueil
});

// Routes pour les propriétés
Route::resource('properties', PropertyController::class);

// Routes pour les réservations
Route::resource('bookings', BookingController::class);

// Autres routes potentielles (exemple)
Route::get('/about', function () {
    return view('about'); // Vue pour la page "À propos"
});

Route::get('/contact', function () {
    return view('contact'); // Vue pour la page de contact
});

// ... d'autres routes ...