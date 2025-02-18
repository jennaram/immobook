<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère user_id
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Clé étrangère property_id
            $table->date('start_date'); // Ajout de la date de début
            $table->date('end_date'); // Ajout de la date de fin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};