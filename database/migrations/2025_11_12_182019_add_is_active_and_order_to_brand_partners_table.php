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
        Schema::table('brand_partners', function (Blueprint $table) {
            // Jika kolom belum ada, tambahkan
            if (!Schema::hasColumn('brand_partners', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('url');
            }
            
            if (!Schema::hasColumn('brand_partners', 'order')) {
                $table->integer('order')->default(0)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brand_partners', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'order']);
        });
    }
};