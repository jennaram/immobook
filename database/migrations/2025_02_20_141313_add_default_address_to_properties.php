<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('address')->default('Non spécifiée')->change(); // Changez 'Non spécifiée' par la valeur par défaut souhaitée
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('address')->nullable(false)->change();// On remet en required
        });
    }
};