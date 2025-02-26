<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;

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

// Route pour afficher les détails d'une propriété (accessible à tous)
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');

// Routes pour les propriétés (restreintes aux administrateurs)
Route::middleware('is_admin')->group(function () {
    Route::resource('properties', PropertyController::class)->except(['show'])->names([
        'index' => 'properties.index',
        'create' => 'properties.create',
        'store' => 'properties.store',
        'edit' => 'properties.edit',
        'update' => 'properties.update',
        'destroy' => 'properties.destroy',
    ]);
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Assurez-vous que cette vue existe
    })->name('IsAdmin.dashboard');
});

// Routes pour les réservations (accessibles uniquement aux utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::resource('bookings', BookingController::class)->names([
        'index' => 'bookings.index',
        'create' => 'bookings.create',
        'store' => 'bookings.store',
        'show' => 'bookings.show',
        'edit' => 'bookings.edit',
        'update' => 'bookings.update',
        'destroy' => 'bookings.destroy',
    ]);

    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard'); // Assurez-vous que cette vue existe
        })->name('IsAdmin.dashboard');
    });
});

// Route pour la page "À propos"
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Route pour le dashboard (corrigée et nommée)
Route::get('/dashboard', function () {
    if (!Auth::user()->is_admin) {
        return redirect()->route('home')->with('error', 'Vous devez être administrateur pour accéder à cette page.');
    }

    $user = Auth::user();

    // Récupérer les réservations à venir (check_in >= aujourd'hui)
    $upcomingBookings = Booking::where('check_in', '>=', now())
        ->with('property') // Charger la relation property
        ->orderBy('check_in')
        ->get();

    // Récupérer les réservations passées (check_out < aujourd'hui)
    $pastBookings = Booking::where('check_out', '<', now())
        ->with('property') // Charger la relation property
        ->orderBy('check_out', 'desc')
        ->get();

    return view('dashboard', compact('upcomingBookings', 'pastBookings'));
})->middleware(['auth'])->name('dashboard');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Routes pour la gestion des favoris (accessibles uniquement aux utilisateurs connectés)
Route::middleware('auth')->group(function () {
    // Ajouter ou supprimer un favori
    Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Récupérer le nombre de favoris
    Route::get('/favorites/count', [FavoriteController::class, 'count'])->name('favorites.count');

    // Afficher la page des favoris
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
});

// Routes d'authentification
require __DIR__ . '/auth.php';
