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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('city')->max(100);
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->string('city')->max(100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('city');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
};
