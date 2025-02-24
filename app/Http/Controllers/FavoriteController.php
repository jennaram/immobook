<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Afficher les propriétés favorites
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favoriteProperties()->with('property')->paginate(10); // Pagination pour gérer un grand nombre de favoris
        return view('favorites.index', compact('favorites'));
    }

    // Ajouter ou supprimer un favori
    public function toggle(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
        ]);

        $user = Auth::user();
        $propertyId = $request->property_id;

        // Vérifier si la propriété est déjà en favori
        $favorite = Favorite::where('user_id', $user->id)
            ->where('property_id', $propertyId)
            ->first();

        if ($favorite) {
            // Supprimer le favori
            $favorite->delete();
            $action = 'removed';
        } else {
            // Ajouter le favori
            Favorite::create([
                'user_id' => $user->id,
                'property_id' => $propertyId,
            ]);
            $action = 'added';
        }

        // Retourner le nombre de favoris mis à jour
        $count = $user->favoriteProperties()->count();

        return response()->json([
            'action' => $action,
            'count' => $count,
        ]);
    }

    // Récupérer le nombre de favoris
    public function count()
    {
        $user = Auth::user();
        $count = $user->favoriteProperties()->count();

        return response()->json([
            'count' => $count,
        ]);
    }
}
