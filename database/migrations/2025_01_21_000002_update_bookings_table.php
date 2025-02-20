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
        Schema::table('bookings', function (Blueprint $table) {
            // Corrigez la colonne updated_at pour éviter l'erreur
            if (Schema::hasColumn('bookings', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->change();
            }

            // Renommez start_date en check_in (si la colonne existe)
            if (Schema::hasColumn('bookings', 'start_date')) {
                $table->renameColumn('start_date', 'check_in');
            }

            // Renommez end_date en check_out (si la colonne existe)
            if (Schema::hasColumn('bookings', 'end_date')) {
                $table->renameColumn('end_date', 'check_out');
            }

            // Ajoutez les nouvelles colonnes (uniquement si elles n'existent pas déjà)
            if (!Schema::hasColumn('bookings', 'total_price')) {
                $table->decimal('total_price', 10, 2)->after('check_out');
            }

            if (!Schema::hasColumn('bookings', 'deposit_paid')) {
                $table->decimal('deposit_paid', 10, 2)->nullable()->after('total_price');
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->string('status')->after('deposit_paid');
            }

            if (!Schema::hasColumn('bookings', 'guest_name')) {
                $table->string('guest_name')->after('status');
            }

            if (!Schema::hasColumn('bookings', 'guest_email')) {
                $table->string('guest_email')->after('guest_name');
            }

            if (!Schema::hasColumn('bookings', 'guest_phone')) {
                $table->string('guest_phone')->nullable()->after('guest_email');
            }

            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable()->after('guest_phone');
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
        Schema::table('bookings', function (Blueprint $table) {
            // Annulez les modifications
            if (Schema::hasColumn('bookings', 'check_in')) {
                $table->renameColumn('check_in', 'start_date');
            }

            if (Schema::hasColumn('bookings', 'check_out')) {
                $table->renameColumn('check_out', 'end_date');
            }

            // Supprimez les colonnes ajoutées
            $columnsToDrop = [
                'total_price',
                'deposit_paid',
                'status',
                'guest_name',
                'guest_email',
                'guest_phone',
                'special_requests',
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('bookings', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Rétablissez la colonne updated_at à son état d'origine si nécessaire
            if (Schema::hasColumn('bookings', 'updated_at')) {
                $table->timestamp('updated_at')->useCurrent()->change();
            }
        });
    }
};