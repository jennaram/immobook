<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('bedrooms')->default(1)->change(); // Remplacez 1 par la valeur par défaut souhaitée
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('bedrooms')->nullable(false)->change(); // On remet en required
        });
    }
};