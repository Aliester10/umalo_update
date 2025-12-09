<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('t_banner', function (Blueprint $table) {
            $table->string('image_mobile')->nullable()->after('image_url');
        });
    }

    public function down(): void
    {
        Schema::table('t_banner', function (Blueprint $table) {
            $table->dropColumn('image_mobile');
        });
    }
};
