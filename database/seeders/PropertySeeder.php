<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property; // Assurez-vous d'importer le modèle Property

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'name' => 'Maison de charme à la campagne',
            'description' => 'Une maison paisible avec un grand jardin.',
            'price_per_night' => 150.00,
            'address' => 'Adresse de la maison 1',
            'bedrooms' => 3,
        ]);

        // Répétez ce bloc pour les 9 autres propriétés
        Property::create([
            'name' => 'Appartement moderne en centre-ville',
            'description' => 'Un appartement élégant avec vue sur la ville.',
            'price_per_night' => 200.00,
            'address' => 'Adresse de l\'appartement 1',
            'bedrooms' => 2,
        ]);

        Property::create([
            'name' => 'Villa de luxe avec piscine',
            'description' => 'Une villa spacieuse avec tous les équipements nécessaires.',
            'price_per_night' => 350.00,
            'address' => 'Adresse de la villa 1',
            'bedrooms' => 6,
        ]);

        Property::create([
            'name' => 'Chalet de montagne confortable',
            'description' => 'Un chalet chaleureux avec une cheminée.',
            'price_per_night' => 180.00,
            'address' => 'Adresse du chalet 2',
            'bedrooms' => 2,
        ]);

        Property::create([
            'name' => 'Maison de plage ensoleillée',
            'description' => 'Une maison de plage avec accès direct à la mer.',
            'price_per_night' => 250.00,
            'address' => 'Adresse de la maison 1',
            'bedrooms' => 3,
        ]);

        Property::create([
            'name' => 'Loft industriel branché',
            'description' => 'Un loft spacieux avec un design unique.',
            'price_per_night' => 220.00,
            'address' => 'Adresse du loft 1',
            'bedrooms' => 4,
        ]);

        Property::create([
            'name' => 'Manoir historique avec parc',
            'description' => 'Un manoir impressionnant avec un grand parc.',
            'price_per_night' => 400.00,
            'address' => 'Adresse du manoir 1',
            'bedrooms' => 12,
        ]);

        Property::create([
            'name' => 'Cabane dans les arbres isolée',
            'description' => 'Une cabane confortable au milieu de la forêt.',
            'price_per_night' => 120.00,
            'address' => 'Adresse de la cabane 1',
            'bedrooms' => 1,
        ]);

        Property::create([
            'name' => 'Penthouse de luxe avec terrasse',
            'description' => 'Un penthouse exclusif avec une vue imprenable.',
            'price_per_night' => 500.00,
            'address' => 'Adresse du penthouse 1',
            'bedrooms' => 6,
        ]);

        Property::create([
            'name' => 'Studio confortable et abordable',
            'description' => 'Un studio pratique et bien situé.',
            'price_per_night' => 100.00,
            'address' => 'Adresse du studio',
            'bedrooms' => 1,
        ]);
    }
}