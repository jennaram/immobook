<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // Propriété 0
        Property::create([
            'name' => 'Villa de luxe à Nosy-Be',
            'description' => 'Une villa paisible dans la nature malgache.',
            'price_per_night' => 150,
            'address' => 'Nosy-Komba',
            'bedrooms' => 5,
            'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 01
        Property::create([
            'name' => 'Bungalow à Sainte-Anne en Guadeloupe',
            'description' => 'Paisible en bord de mer.',
            'price_per_night' => 100,
            'address' => '35 rue Sainte-Anne',
            'bedrooms' => 5,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1681922761648-d5e2c3972982?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 1
        Property::create([
            'name' => 'Maison de charme à la campagne',
            'description' => 'Une maison paisible avec un grand jardin.',
            'price_per_night' => 150,
            'address' => '123 Rue de la Campagne',
            'bedrooms' => 3,
            'image_url' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 2
        Property::create([
            'name' => 'Appartement moderne en centre-ville',
            'description' => 'Un appartement élégant avec vue sur la ville.',
            'price_per_night' => 200,
            'address' => '456 Rue de la Ville',
            'bedrooms' => 2,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1674676471417-07f613528a94?q=80&w=2890&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 3
        Property::create([
            'name' => 'Villa de luxe en bord de mer',
            'description' => 'Une villa spacieuse avec piscine et accès direct à la plage.',
            'price_per_night' => 500,
            'address' => '789 Avenue de la Plage',
            'bedrooms' => 5,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1682377521564-b180edfc960c?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 4
        Property::create([
            'name' => 'Loft industriel à Brooklyn',
            'description' => 'Un loft branché avec une décoration moderne et une vue imprenable.',
            'price_per_night' => 300,
            'address' => '1011 Rue de Brooklyn',
            'bedrooms' => 2,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1661881888792-80a1297a5b9e?q=80&w=2944&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 5
        Property::create([
            'name' => 'Chalet de montagne avec cheminée',
            'description' => 'Un chalet chaleureux idéal pour les vacances d\'hiver.',
            'price_per_night' => 250,
            'address' => '1213 Route de la Montagne',
            'bedrooms' => 3,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1736194027876-a658c5a1b5ec?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 6
        Property::create([
            'name' => 'Maison de famille avec jardin',
            'description' => 'Une maison confortable parfaite pour les familles avec enfants.',
            'price_per_night' => 180,
            'address' => '1415 Rue de la Famille',
            'bedrooms' => 4,
            'image_url' => 'https://plus.unsplash.com/premium_photo-1687960116909-096420a63d5a?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 7
        Property::create([
            'name' => 'Appartement cosy dans le Marais',
            'description' => 'Un appartement charmant au cœur du quartier historique du Marais.',
            'price_per_night' => 220,
            'address' => '1617 Rue du Marais',
            'bedrooms' => 1,
            'image_url' => 'https://images.unsplash.com/photo-1499916078039-922301b0eb9b?q=80&w=2585&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 8
        Property::create([
            'name' => 'Penthouse avec terrasse panoramique',
            'description' => 'Un penthouse luxueux avec une vue imprenable sur la ville.',
            'price_per_night' => 400,
            'address' => '1819 Avenue du Panorama',
            'bedrooms' => 3,
            'image_url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 9
        Property::create([
            'name' => 'Manoir historique en Toscane',
            'description' => 'Un manoir élégant avec des jardins magnifiques et une vue sur les collines toscanes.',
            'price_per_night' => 600,
            'address' => '2021 Route de Toscane',
            'bedrooms' => 6,
            'image_url' => 'https://images.unsplash.com/photo-1595199644559-6d5ee4e48355?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);

        // Propriété 10
        Property::create([
            'name' => 'Cabane de pêcheur au bord de l\'eau',
            'description' => 'Une cabane rustique idéale pour les amoureux de la nature et de la pêche.',
            'price_per_night' => 100,
            'address' => '2223 Chemin du Bord de l\'Eau',
            'bedrooms' => 2,
            'image_url' => 'https://images.unsplash.com/photo-1662029376890-8beae643a41b?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', // Remplacez par une URL réelle
        ]);
    }
}
