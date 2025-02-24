<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('guest_email');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('guest_email')->default('guest@example.com');
        });
    }
};
