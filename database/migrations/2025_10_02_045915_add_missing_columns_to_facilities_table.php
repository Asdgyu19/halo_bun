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
        Schema::table('facilities', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false)->after('notes');
            $table->boolean('is_24_hours')->default(false)->after('is_verified');
            $table->string('city')->nullable()->after('address');
            $table->integer('views_count')->default(0)->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['is_verified', 'is_24_hours', 'city', 'views_count']);
        });
    }
};
