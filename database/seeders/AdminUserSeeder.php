<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Importez le modèle User
use Illuminate\Support\Facades\Hash; // Pour hasher le mot de passe

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Créer ou mettre à jour l'utilisateur administrateur
        User::updateOrCreate(
            ['email' => 'admin2@example.com'], // Critère de recherche
            [
                'name' => 'Admin', // Nom de l'administrateur
                'password' => Hash::make('adminpasswordjenna'), // Mot de passe (changez-le)
                'is_admin' => true, // Définir l'utilisateur comme administrateur
            ]
        );

        // Créer ou mettre à jour l'utilisateur Jenna
        User::updateOrCreate(
            ['email' => 'jenna@example.com'], // Critère de recherche
            [
                'name' => 'Jenna', // Nom de l'administrateur
                'password' => Hash::make('adminpasswordjenna'), // Mot de passe (changez-le)
                'is_admin' => true, // Définir l'utilisateur comme administrateur
            ]
        );

        // Créer ou mettre à jour un utilisateur non administrateur
        User::updateOrCreate(
            ['email' => 'ethan@example.com'], // Critère de recherche
            [
                'name' => 'ethan', // Nom de l'utilisateur
                'password' => Hash::make('12345678'), // Mot de passe (changez-le)
                'is_admin' => false, // Définir l'utilisateur comme non administrateur
            ]
        );

        // Message de confirmation
        $this->command->info('Administrateurs créés ou mis à jour avec succès !');
    }
}
