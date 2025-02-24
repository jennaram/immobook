<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('name'); // Nom de la propriété
            $table->text('description')->nullable(); // Description (peut être NULL)
            $table->decimal('price_per_night', 8, 2)->nullable(); // Prix par nuit (peut être NULL)
            $table->string('address')->nullable(); // Adresse (peut être NULL)
            $table->integer('bedrooms')->nullable();  // Nombre de chambres (peut être NULL)
            // Ajoutez ici les autres colonnes de votre table properties
            $table->string('image_url')->nullable(); // Exemple : URL de l'image
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
