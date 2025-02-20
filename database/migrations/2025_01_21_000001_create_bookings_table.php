<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('user_id')->nullable(); // Exemple : nullable
            $table->unsignedBigInteger('property_id')->nullable(); // Exemple : nullable
            $table->date('check_in')->nullable(); // Exemple : nullable
            $table->date('check_out')->nullable(); // Exemple : nullable
            $table->decimal('total_price', 10, 2)->nullable(); // Exemple: nullable
            $table->timestamps(); // created_at et updated_at

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};