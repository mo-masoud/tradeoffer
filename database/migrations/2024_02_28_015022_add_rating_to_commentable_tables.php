<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('rating', 2, 1)->unsigned()->after('discount')->default(0);
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->decimal('rating', 2, 1)->unsigned()->after('is_active')->default(0);
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->decimal('rating', 2, 1)->unsigned()->after('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('rating');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('rating');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('rating');
        });
    }
};