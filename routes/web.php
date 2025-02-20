<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici, vous pouvez enregistrer les routes web pour votre application. Ces
| routes sont chargées par le RouteServiceProvider dans un groupe qui
| contient le groupe middleware "web". Maintenant, créez quelque chose de génial !
|
*/


// Route d'accueil (corrigée)
Route::get('/', [HomeController::class, 'index'])->name('home'); // <-- Utilise le contrôleur et la méthode index




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

// Route pour le dashboard (corrigée et nommée)
Route::get('/dashboard', function () {
    $user = Auth::user();
    $upcomingBookings = Booking::where('user_id', $user->id)
        ->where('start_date', '>=', now())
        ->get();

    $pastBookings = Booking::where('user_id', $user->id)
        ->where('end_date', '<', now())
        ->get();

    return view('dashboard', compact('upcomingBookings', 'pastBookings'));
})->middleware(['auth'])->name('dashboard'); // <-- Nommée 'dashboard'

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Routes d'authentification
require __DIR__ . '/auth.php';