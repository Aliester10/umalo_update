<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('t_activities', function (Blueprint $table) {
            if (Schema::hasColumn('t_activities', 'coming_so_on')) {
                $table->dropColumn('coming_so_on');
            }
        });
    }

    public function down(): void
    {
        Schema::table('t_activities', function (Blueprint $table) {
            if (!Schema::hasColumn('t_activities', 'coming_so_on')) {
                $table->char('coming_so_on', 1)->nullable()->default('N');
            }
        });
    }
};
