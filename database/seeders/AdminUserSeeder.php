<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importez le modèle User
use Illuminate\Support\Facades\Hash; // Pour hasher le mot de passe

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Créer un utilisateur administrateur
        User::create([
            'name' => 'Admin', // Nom de l'administrateur
            'email' => 'admin@example.com', // Email de l'administrateur
            'password' => Hash::make('adminpasswordjenna'), // Mot de passe (changez-le)
            'is_admin' => true, // Définir l'utilisateur comme administrateur
        ]);

        // Message de confirmation
        $this->command->info('Administrateur créé avec succès !');
    }
}