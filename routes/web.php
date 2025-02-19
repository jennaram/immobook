<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;


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
Route::resource('properties', PropertyController::class)->names([
    'index' => 'properties.index',
    'create' => 'properties.create',
    'store' => 'properties.store',
    'show' => 'properties.show',
    'edit' => 'properties.edit',
    'update' => 'properties.update',
    'destroy' => 'properties.destroy',
]);

// Routes pour les réservations
Route::resource('bookings', BookingController::class)->names([
    'index' => 'bookings.index',
    'create' => 'bookings.create',
    'store' => 'bookings.store',
    'show' => 'bookings.show',
    'edit' => 'bookings.edit',
    'update' => 'bookings.update',
    'destroy' => 'bookings.destroy',
]);

// Autres routes potentielles (exemple)
Route::get('/about', function () {
    return view('about'); // Vue pour la page "À propos"
});

Route::get('/contact', function () {
    return view('contact'); // Vue pour la page de contact
});

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard'); // Ou la vue que vous souhaitez afficher pour le dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes d'authentification (si vous utilisez Breeze, Jetstream ou autre)
require __DIR__.'/auth.php'; // ou le chemin vers vos routes d'authentification