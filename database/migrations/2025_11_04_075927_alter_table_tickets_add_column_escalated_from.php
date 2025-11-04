<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('escalated_from')
              ->nullable()                // <-- IMPORTANT
              ->after('assigned_to')
              ->constrained('users')      // references users(id)
              ->nullOnDelete();           // set null on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['escalated_from']);
            $table->dropColumn('escalated_from');
        });
    }
};
