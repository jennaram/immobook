<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Corriger la colonne `updated_at` pour éviter l'erreur de valeur par défaut invalide
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'updated_at')) {
                $table->timestamp('updated_at')->default(now())->change();
            }
        });

        // Ajouter les nouvelles colonnes `address` et `bedrooms`
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'address')) {
                $table->string('address')->after('description');
            }

            if (!Schema::hasColumn('properties', 'bedrooms')) {
                $table->integer('bedrooms')->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Supprimer les colonnes `address` et `bedrooms`
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'address')) {
                $table->dropColumn('address');
            }

            if (Schema::hasColumn('properties', 'bedrooms')) {
                $table->dropColumn('bedrooms');
            }
        });

        // Rétablir la colonne `updated_at` à son état d'origine (si nécessaire)
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'updated_at')) {
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00')->change();
            }
        });
    }
};